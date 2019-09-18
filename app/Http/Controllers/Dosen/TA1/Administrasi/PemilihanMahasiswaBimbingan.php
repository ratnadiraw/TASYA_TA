<?php

namespace App\Http\Controllers\Dosen\TA1\Administrasi;

use App\Http\Controllers\Controller;
use App\Topik;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class PemilihanMahasiswaBimbingan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosenId = Auth::user()->id;
        $listOfTopics = Topik::where('status_buka',true)->where('pembimbing1_id', $dosenId)->orWhere('pembimbing2_id', $dosenId)->get();
        foreach ($listOfTopics as $topic) {
            $mahasiswa = DB::table('pilihan_topik')->where('prioritas1', $topic->topik_id)->orWhere('prioritas2',$topic->topik_id)->orWhere('prioritas3',$topic->topik_id)
                ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'pilihan_topik.ta_id')
                ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
                ->orderBy('mahasiswa.nim', 'asc')
                ->get();
            $data['mahasiswa'.$topic->topik_id] = $mahasiswa;
        }
        $data['listOfTopics'] = $listOfTopics;
        if (count($listOfTopics) > 0) {
            $listOfTopicIDs = Topik::where('pembimbing1_id', $dosenId)->orWhere('pembimbing2_id', $dosenId)->pluck('topik_id');
            $listOfTopicIDs = $listOfTopicIDs->toArray();
            //Display Mahasiswa Bimbingan
            $data['listOfMahasiswaBimbingan'] = DB::table('mahasiswa_bimbingan_pilihan')->whereIn('mahasiswa_bimbingan_pilihan.topik_id',$listOfTopicIDs)
                                                ->join('mahasiswa', 'mahasiswa.user_id', '=', 'mahasiswa_bimbingan_pilihan.mahasiswa_id')
                                                ->join('topik', 'topik.topik_id', '=', 'mahasiswa_bimbingan_pilihan.topik_id')
                                                ->select('mahasiswa_bimbingan_pilihan.prioritas as prioritas','mahasiswa.*','mahasiswa.nama as mahasiswa_nama', 'topik.nama', 'topik.topik_id')
                                                ->orderBy('mahasiswa_bimbingan_pilihan.prioritas', 'asc')
                                                ->get();
        }

        return view('dosen.ta1.administrasi.pemilihan_mahasiswa', $data);
    }

    public function saveMahasiswaBimbingan(Request $request)
    {
        $request->validate([
            'mahasiswa-priority' => 'required',
        ]);
        $errors = [];
        $priority = $request->input('mahasiswa-priority');
        $mahasiswaId = $request->input('mahasiswa-id');
        $topicId = $request->input('topic-id');

        $dosenId = Auth::user()->id;

        $listOfTopics = DB::table('mahasiswa_bimbingan_pilihan')
            ->join('topik', 'topik.topik_id', '=', 'mahasiswa_bimbingan_pilihan.topik_id')
            ->where('topik.pembimbing1_id', $dosenId)
            ->orWhere('topik.pembimbing2_id', $dosenId)
            ->get();
        //Delete if found or Error if same priority found
        foreach ($listOfTopics as $topic) {
            if ($topic->prioritas == $priority && $topic->mahasiswa_id != $mahasiswaId) {
                array_push($errors, 'Sudah terdapat calon mahasiswa bimbingan pilihan dengan prioritas '.$priority);
                return Redirect::back()->withErrors($errors);
            }
            if ($topic->prioritas == $priority && $topic->mahasiswa_id == $mahasiswaId) {
                $quotaTopic = DB::table('topik')
                    ->where('topik_id', $topic->topik_id)
                    ->pluck('kuota')
                    ->first();

                DB::table('mahasiswa_bimbingan_pilihan')
                    ->where('topik_id', $topic->topik_id)
                    ->where('mahasiswa_id', $mahasiswaId)
                    ->delete();

                $quotaTopic++;
                DB::table('topik')
                    ->where('topik_id', $topic->topik_id)
                    ->update(['kuota' => $quotaTopic]);
            }
        }

        //Kuota Management for One Dosen
        $jumlahMahasiswaBimbingan = DB::table('mahasiswa_bimbingan_pilihan')
            ->join('topik', 'topik.topik_id', '=', 'mahasiswa_bimbingan_pilihan.topik_id')
            ->where('topik.pembimbing1_id', $dosenId)
            ->count();

        $jumlahMahasiswaBimbingan += DB::table('ta1_tugas_akhir')
            ->join('ta1_dosen_ta', 'ta1_dosen_ta.ta_id', '=', 'ta1_tugas_akhir.id')
            ->where('ta1_dosen_ta.dosen_id', $dosenId)
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->count();

        if ($jumlahMahasiswaBimbingan >= config('constants.ta1.kuota_dosen')) {
            array_push($errors, 'Kuota bimbingan Anda sebagai dosen penuh, dimohon untuk mengontak administrator jika ingin menambahkan kuota dosen ');
        } else {
            //Kuota Management for Each Topic
            //Insert
            $quotaTopic = DB::table('topik')
                ->where('topik_id', $topicId)
                ->pluck('kuota')
                ->first();
            if ($quotaTopic > 0) {
                DB::table('mahasiswa_bimbingan_pilihan')
                    ->insert(
                        ['mahasiswa_id' => $mahasiswaId, 'topik_id' => $topicId, 'prioritas' => $priority]
                    );

                $quotaTopic--;
                DB::table('topik')
                    ->where('topik_id', $topicId)
                    ->update(['kuota' => $quotaTopic]);
            } else {
                $topicName = DB::table('topik')
                    ->where('topik_id', $topicId)
                    ->pluck('nama')
                    ->first();
                array_push($errors, $topicName.' penuh');
            }
        }
        return Redirect::back()->withErrors($errors);

    }

    public function deleteMahasiswaBimbingan(Request $request)
    {
        $mahasiswaId = $request->input('mahasiswa-id');
        $topicId = $request->input('topic-id');

        $quotaTopic = DB::table('topik')
            ->where('topik_id', $topicId)
            ->pluck('kuota')
            ->first();

        DB::table('mahasiswa_bimbingan_pilihan')
            ->where('topik_id', $topicId)
            ->where('mahasiswa_id', $mahasiswaId)
            ->delete();

        $quotaTopic++;
        DB::table('topik')
            ->where('topik_id', $topicId)
            ->update(['kuota' => $quotaTopic]);

        return redirect('/dosen/ta1/administrasi/pemilihan_mahasiswa_bimbingan');
    }
}
