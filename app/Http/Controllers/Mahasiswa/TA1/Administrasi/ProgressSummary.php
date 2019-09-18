<?php

namespace App\Http\Controllers\Mahasiswa\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;
use App\TA1_Seminar;
use Illuminate\Support\Facades\DB;

class ProgressSummary extends Controller
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
        $user_id = Auth::user()->id;
        $mahasiswa = Mahasiswa::find($user_id);
        $data['mahasiswa'] = $mahasiswa;
        $currentTA = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();
        $data['currentTA'] = $currentTA;
        if (isset($currentTA)) {
            $progressSummary = $currentTA->progressSummary;
            $data['progressSummary'] = $progressSummary;
            $listOfTugas = $progressSummary->tugas;
            $data['listOfTugas'] = $listOfTugas;
            $listOfPembimbing = $currentTA->pembimbing;
            $data['listOfPembimbing'] = $listOfPembimbing;
            $seminar = $currentTA->seminar;
            $data['seminar'] = $seminar;
        }
        return view('mahasiswa.ta1.administrasi.progress_summary',$data);
    }

    public function downloadBAP($id) {
        $bap = TA1_Seminar::find($id)->berkas_seminar;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }
}
