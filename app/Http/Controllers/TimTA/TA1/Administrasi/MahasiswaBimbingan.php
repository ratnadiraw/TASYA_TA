<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use App\TA1_Tugas_Akhir;
use App\Dosen;
use App\Topik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

class MahasiswaBimbingan extends Controller
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
    public function index()
    {
        $listOfDosen = Dosen::all();
        foreach ($listOfDosen as $dosen) {
            $dosenQuota = 0;
            $listOfDosenTA = $dosen->TA1_Tugas_Akhir;
            foreach ($listOfDosenTA as $TA) {
                if ($TA->status_checkout === 0) {
                    $dosenQuota++;
                }
            }
            $dosen->setAttribute('kuota_bimbingan',$dosenQuota);
            $listOfTopic = $dosen->topik_buka;
            $listOfChosenMahasiswa = collect([]);
            foreach ($listOfTopic as $topic) {
                $chosenMahasiswas = $topic->mahasiswaBimbinganPilihan()->with('mahasiswa','topik')->get();
                foreach ($chosenMahasiswas as $chosenMahasiswa) {
                    $mahasiswa = $chosenMahasiswa->mahasiswa;
                    $currentTA = TA1_Tugas_Akhir::where('mahasiswa_id',$mahasiswa->user_id)->first();
                    $mahasiswa->setAttribute('currentTA1',$currentTA);
                    $listOfChosenMahasiswa->push($chosenMahasiswa);
                }
            }
            $listOfChosenMahasiswa = $listOfChosenMahasiswa->sortBy('prioritas');
            $dosen->setAttribute('listOfChosenMahasiswa',$listOfChosenMahasiswa);
        }
        $data['listOfDosen'] = $listOfDosen;
        return view('tim_ta.ta1.administrasi.daftar_mahasiswa_bimbingan', $data);
    }
    public function setTATopic(Request $request) {
        $taID = $request->input('ta-id');
        $topicID = $request->input('topic-id');
        $listOfDosen = Dosen::all();

        $listOfPembimbingID = array();
        $topic = Topik::find($topicID);
        array_push($listOfPembimbingID,$topic->pembimbing1_id);
        if ($topic->pembimbing2_id !== null) {
            array_push($listOfPembimbingID,$topic->pembimbing2_id);
        }
        $TA = TA1_Tugas_Akhir::find($taID);
        $TA->pembimbing()->sync($listOfPembimbingID);
        $TA->topik_id = $topic->topik_id;
        $TA->nama_topik = $topic->nama;
        $TA->save();
        foreach ($listOfDosen as $dosen) {
            $dosenQuota = 0;
            $listOfDosenTA = $dosen->TA1_Tugas_Akhir;
            foreach ($listOfDosenTA as $TA) {
                if ($TA->status_checkout === 0) {
                    $dosenQuota++;
                }
            }
            $dosen->setAttribute('kuotaBimbingan',$dosenQuota);
        }
        return response()->json(array('listOfDosen'=> json_encode($listOfDosen)), 200);
    }
    public function finalize(Request $request)
    {
        $dosenIDs = $request->input('dosen-id');
        $approvedTopics = $request->input('approved-topic');
        $listOfFinalizableTAIDs = collect([]);
        foreach ($dosenIDs as $dosenID) {
            $dosen = Dosen::find($dosenID);
            $listOfTopic = $dosen->topik_buka;
            foreach ($listOfTopic as $topic) {
                $chosenMahasiswas = $topic->mahasiswaBimbinganPilihan()->with('mahasiswa','topik')->get();
                foreach ($chosenMahasiswas as $chosenMahasiswa) {
                    $mahasiswa = $chosenMahasiswa->mahasiswa;
                    $currentTA = TA1_Tugas_Akhir::where('mahasiswa_id',$mahasiswa->user_id)->first();
                    $listOfFinalizableTAIDs->push($currentTA->id);
                }
            }
        }
        $listOfFinalizableTAIDs = $listOfFinalizableTAIDs->unique();
        foreach ($listOfFinalizableTAIDs as $taID) {
            if (!isset($approvedTopics[$taID]) || $approvedTopics[$taID] === null) {
                Session::flash('message', "Pastikan semua mahasiswa telah mendapatkan dosen pembimbing");
                return back();
            }
            DB::table('pilihan_topik')->where('ta_id',$taID)->delete();
        }
        DB::table('mahasiswa_bimbingan_pilihan')->truncate();
        return redirect('/tim_ta/ta1/administrasi/daftar_topik');
    }
}
