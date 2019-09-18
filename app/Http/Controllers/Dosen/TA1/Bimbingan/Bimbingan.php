<?php

namespace App\Http\Controllers\Dosen\TA1\Bimbingan;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\Topik;
use App\TA1_MoM;
use App\TA1_Tugas_Akhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Bimbingan extends Controller
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
        $listOfTopikBimbingan = Topik::where('status_buka',true)->where('pembimbing1_id', $dosenID)->orWhere('pembimbing2_id', $dosenID)->get();
        foreach ($listOfTopikBimbingan as $key => $topic) {
            $listOfActiveTA1 = $topic->ongoing_TA1_Tugas_Akhir()->get();
            if (count($listOfActiveTA1) == 0) {
                $listOfTopikBimbingan->forget($key);
            }
        }

        return view('dosen.ta1.bimbingan.daftar_topik_bimbingan')->with(['listOfTopikBimbingan' => $listOfTopikBimbingan]);
    }

    public function progressBimbingan($ta_id)
    {
        $TA = TA1_Tugas_Akhir::find($ta_id);
        $mahasiswa = $TA->mahasiswa;
        $dosenID = Auth::user()->id;
        $listOfBimbingan = $TA->bimbingan->where('pembimbing_id','=',$dosenID);
        return view('dosen.ta1.bimbingan.progress_bimbingan')->with(['listOfBimbingan' => $listOfBimbingan,'TA' => $TA, 'mahasiswa' => $mahasiswa]);
    }

    public function editMoMBimbingan(Request $request)
    {
        $dosenID = Auth::user()->id;
        $momID = $request->input('mom-id');
        $taID = $request->input('ta-id');
        $MoM = TA1_MoM::find($momID);
        return view('dosen.ta1.bimbingan.edit_mom_bimbingan')->with(['taID' => $taID,'MoM' => $MoM]);
    }

    public function viewMoMBimbingan(Request $request)
    {
        $dosenID = Auth::user()->id;
        $momID = $request->input('mom-id');
        $taID = $request->input('ta-id');
        $MoM = TA1_MoM::find($momID);
        return view('dosen.ta1.bimbingan.view_mom_bimbingan')->with(['taID' => $taID,'MoM' => $MoM]);
    }

    public function updateMoMBimbingan(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $taID = $request->input('ta-id');
        $TA = TA1_Tugas_Akhir::find($taID);
        $momID = $request->input('mom-id');
        $action = $request->input('action');
        $MoM = TA1_MoM::find($momID);
        $comment = $request->input('comment');
        $MoM->komentar = $comment;
        if ($action == 'approve') {
            $MoM->status_persetujuan = true;
            $progressSummary = $TA->progressSummary;
            $nBimbingan = $progressSummary->jumlah_bimbingan;
            $nBimbingan++;
            $progressSummary->jumlah_bimbingan = $nBimbingan;
            $progressSummary->save();
        } else if ($action == 'decline') {
            $MoM->status_persetujuan = false;
        }
        $MoM->save();

        return redirect('/dosen/ta1/bimbingan/perkembangan_bimbingan/'.$taID);
    }
}
