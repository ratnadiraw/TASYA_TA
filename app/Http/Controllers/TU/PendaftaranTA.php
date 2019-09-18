<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\TA1_ProgressSummary;
use App\TA1_Tugas_Akhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PendaftaranTA extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTA1()
    {
        $listOfMahasiswa = Mahasiswa::get();
        $listOfTahunAjaran = DB::table('tahun_ajaran')
            ->get();

        return view('tu.pendaftaran.ta_1',  [
            'listOfMahasiswa' => $listOfMahasiswa,
            'listOfTahunAjaran' => $listOfTahunAjaran
        ]);
    }


    public function registerTA1(Request $request) {
        $mahasiswaIds = $request->input('mahasiswa-id');
        $counter = 0;
        $errors = [];
        foreach ($mahasiswaIds as $mahasiswaId) {
            if (null !== $request->input('register-'.$mahasiswaId)) {
                if (null !== $request->input('tahun-ajaran-'.$mahasiswaId)) {
                    $passingSKS = $request->input('passing-sks-'.$mahasiswaId);
                    if (isset($passingSKS) && $passingSKS >= config('constants.ta1.pendaftaran_ta.sks_lulus')) {
                        if (null === $request->input('registered-'.$mahasiswaId) ||
                            (null !== $request->input('registered-'.$mahasiswaId) &&
                                $request->input('checkout-status-'.$mahasiswaId)) == 1) {
                            $TA = new TA1_Tugas_Akhir;
                            $TA->mahasiswa_id = $mahasiswaId;
                            $TA->tahun_ajaran_id = $request->input('tahun-ajaran-'.$mahasiswaId);
                            $TA->save();

                            $progressSum = new TA1_ProgressSummary;
                            $progressSum->ta_id =$TA->id;
                            $progressSum->jumlah_kehadiran_kelas = 0;
                            $progressSum->jumlah_bimbingan = 0;
                            $progressSum->jumlah_kehadiran_seminar = 0;
                            $progressSum->save();

                            DB::table('pilihan_topik')->insert(['ta_id' => $TA->id]);
                        } else {
                            array_push($errors ,'Mahasiswa '.$request->input('mahasiswa-name-'.$mahasiswaId).' sudah pernah mendaftar');
                        }
                    } else {
                        array_push($errors ,'Mahasiswa '.$request->input('mahasiswa-name-'.$mahasiswaId).' jumlah SKS lulus tidak mencukupi');
                    }
                } else {
                    array_push($errors ,'Mahasiswa '.$request->input('mahasiswa-name-'.$mahasiswaId).' tahun ajaran tidak boleh kosong');
                }
            }
            $counter++;
        }
        return Redirect::back()->withErrors($errors);
    }


    public function registerTA2(Mahasiswa $mahasiswa) {
        $ta2 = new TA2_TA;
        $ta2->mahasiswa_id = $mahasiswa->user_id;
        $ta2->topik = "machine_learning";
        $ta2->status_lulus = 0;
        $ta2->save();

        DB::table('ta2_dosen_ta')
            ->insert([
                'ta_id' => $ta2->ta_id,
                'dosen_id' => 2,
            ]);

        DB::table('ta2_dosen_ta')
            ->insert([
                'ta_id' => $ta2->ta_id,
                'dosen_id' => 3,
            ]);

        $current_mahasiswa = Mahasiswa::find($mahasiswa->user_id);
        $current_mahasiswa->current_ta2_id = $ta2->ta_id;
        $current_mahasiswa->save();

        $progressSum = new TA2_Progress_Summary;
        $progressSum->ta_id = $ta2->ta_id;
        $progressSum->jumlah_kehadiran_kelas = 0;
        $progressSum->jumlah_kehadiran_seminar = 0;
        $progressSum->status_pengumpulan = 0;
        $progressSum->save();
    }
}
