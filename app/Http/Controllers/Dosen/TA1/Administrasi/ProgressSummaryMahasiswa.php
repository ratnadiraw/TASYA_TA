<?php

namespace App\Http\Controllers\Dosen\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TA1_Tugas_Akhir;
use App\Topik;
use App\Dosen;

class ProgressSummaryMahasiswa extends Controller
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
        $dosenID = Auth::user()->id;
        $dosen = Dosen::find($dosenID);
        $listOfTopikBimbingan = Topik::where('status_buka',true)->where('pembimbing1_id', $dosenID)->orWhere('pembimbing2_id', $dosenID)->get();
        foreach ($listOfTopikBimbingan as $key => $topic) {
            $listOfActiveTA1 = $topic->ongoing_TA1_Tugas_Akhir()->get();
            if (count($listOfActiveTA1) == 0) {
                $listOfTopikBimbingan->forget($key);
            }
        }
        return view('dosen.ta1.administrasi.progress_summary')->with(['listOfTopikBimbingan' => $listOfTopikBimbingan]);
    }

    public function detail(Request $request)
    {
        $taID = $request->input('ta-id');
        $currentTA = TA1_Tugas_Akhir::find($taID);
        $mahasiswa = $currentTA->mahasiswa;
        $listOfPembimbing = $currentTA->pembimbing;
        $progressSummary = $currentTA->progressSummary;
        $listOfTugas = $progressSummary->tugas;
        $seminar = $currentTA->seminar;
        return view('dosen.ta1.administrasi.detail_progress_summary')->with(['mahasiswa' => $mahasiswa,'listOfPembimbing' => $listOfPembimbing,'currentTA' =>$currentTA, 'progressSummary' => $progressSummary,'listOfTugas' => $listOfTugas,'seminar' => $seminar]);
    }

    public function downloadBAP($id) {
        $bap = TA1_Seminar::find($id)->berkas_seminar;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }
}
