<?php

namespace App\Http\Controllers\Mahasiswa\TA1\Bimbingan;

use App\Http\Controllers\Controller;
use App\TA1_Bimbingan;
use App\TA1_MoM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;

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
        $mahasiswaID = Auth::user()->id;
        $mahasiswa = Mahasiswa::find($mahasiswaID);
        $currentTA = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();
        $data['currentTA'] = $currentTA;
        if (isset($currentTA)) {
            $listOfBimbingan = $currentTA->bimbingan;
            $data['listOfBimbingan'] = $listOfBimbingan;
            $listOfPembimbing = $currentTA->pembimbing;
            $data['listOfPembimbing'] = $listOfPembimbing;
        }
        return view('mahasiswa.ta1.bimbingan.daftar_bimbingan',$data);
    }

    public function saveBimbingan(Request $request)
    {
        $mahasiswaID = Auth::user()->id;
        $request->validate([
            'pembimbing' => 'required',
            'bimbingan-date' => 'required|date',
            'discussion' => 'required',
            'follow-up' => 'required',
            'next-bimbingan-date' => 'required|date',
        ]);
        $pembimbingID = $request->input('pembimbing');
        $bimbinganDate = $request->input('bimbingan-date');
        $momDiscussion = $request->input('discussion');
        $momFollowUp = $request->input('follow-up');
        $momNextBimbinganDate = $request->input('next-bimbingan-date');

        $mahasiswa = Mahasiswa::find($mahasiswaID);
        $currentTA = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();

        $prevBimbingan = TA1_Bimbingan::where('tanggal','=',$bimbinganDate)->first();
        if (isset($prevBimbingan)) {
            $prevMoM = $prevBimbingan->MoM;
            if ($prevMoM->status_persetujuan === 0) {
                $prevMoM->delete();
                $prevBimbingan->delete();
            }
            $bimbingan = new TA1_Bimbingan;
            $bimbingan->mahasiswa_id = $mahasiswaID;
            $bimbingan->pembimbing_id = $pembimbingID;
            $bimbingan->ta_id = $currentTA->id;
            $bimbingan->tanggal = $bimbinganDate;
            $bimbingan->save();

            $MoM = new TA1_MoM;
            $MoM->bimbingan_id = $bimbingan->id;
            $MoM->hasil_diskusi = $momDiscussion;
            $MoM->tindak_lanjut = $momFollowUp;
            $MoM->tangal_bimbingan_berikutnya = $momNextBimbinganDate;
            $MoM->save();
        } else {
            $bimbingan = new TA1_Bimbingan;
            $bimbingan->mahasiswa_id = $mahasiswaID;
            $bimbingan->pembimbing_id = $pembimbingID;
            $bimbingan->ta_id = $currentTA->id;
            $bimbingan->tanggal = $bimbinganDate;
            $bimbingan->save();

            $MoM = new TA1_MoM;
            $MoM->bimbingan_id = $bimbingan->id;
            $MoM->hasil_diskusi = $momDiscussion;
            $MoM->tindak_lanjut = $momFollowUp;
            $MoM->tangal_bimbingan_berikutnya = $momNextBimbinganDate;
            $MoM->save();
        }
        return redirect('/mahasiswa/ta1/bimbingan/daftar_bimbingan');
    }

    public function addNewBimbingan(Request $request)
    {
        $mahasiswaID = Auth::user()->id;
        $mahasiswa = Mahasiswa::find($mahasiswaID);
        $currentTA = $mahasiswa->ta1_Tugas_Akhir()->latest()->first();
        $listOfPembimbing = $currentTA->pembimbing;
        return view('mahasiswa.ta1.bimbingan.add_bimbingan')->with(['listOfPembimbing' =>$listOfPembimbing]);
    }

    public function editMoM(Request $request)
    {
        $momID = $request->input('mom-id');
        $MoM = TA1_MoM::find($momID);
        $bimbingan = $MoM->bimbingan;
        $TA = $bimbingan->TA1_Tugas_Akhir;
        $listOfPembimbing = $TA->pembimbing;
        $pembimbing = $listOfPembimbing->find($bimbingan->pembimbing_id);
        $data['MoM'] = $MoM;
        $data['pembimbing'] = $pembimbing;
        return view('mahasiswa.ta1.bimbingan.edit_mom',$data);
    }

    public function viewMoM(Request $request)
    {
        $momID = $request->input('mom-id');
        $MoM = TA1_MoM::find($momID);
        $bimbingan = $MoM->bimbingan;
        $TA = $bimbingan->TA1_Tugas_Akhir;
        $listOfPembimbing = $TA->pembimbing;
        $pembimbing = $listOfPembimbing->find($bimbingan->pembimbing_id);
        $data['MoM'] = $MoM;
        $data['pembimbing'] = $pembimbing;
        return view('mahasiswa.ta1.bimbingan.view_mom',$data);
    }

    public function updateMoM(Request $request)
    {
        $request->validate([
            'discussion' => 'required',
            'follow-up' => 'required',
            'next-bimbingan-date' => 'required|date',
        ]);
        $momID = $request->input('mom-id');
        $momDiscussion = $request->input('discussion');
        $momFollowUp = $request->input('follow-up');
        $momNextBimbinganDate = $request->input('next-bimbingan-date');

        $MoM = TA1_MoM::find($momID);
        $MoM->hasil_diskusi = $momDiscussion;
        $MoM->tindak_lanjut = $momFollowUp;
        $MoM->tangal_bimbingan_berikutnya = $momNextBimbinganDate;
        $MoM->save();
        return redirect('/mahasiswa/ta1/bimbingan/daftar_bimbingan');
    }
}
