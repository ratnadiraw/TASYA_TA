<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\TA2_Bimbingan;
use App\TA2_TA;
use App\User;
use App\TA2TA;
use App\TA2Bimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class BimbinganTA2 extends Controller
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
    public function bimbingan()
    {
          //get mahasiswa_id
          $mahasiswa_id = session('user_id');
          $mahasiswa = Mahasiswa::findOrFail($mahasiswa_id);

          //get ta
          $ta2_id = Mahasiswa::findOrFail($mahasiswa_id)->current_ta2_id;
          $ta2 = TA2_TA::findOrFail($ta2_id);

          //get dosen_pembimbing
          $dosen_pembimbings = $ta2->dosen()->get();

          //get bimbingan
          $bimbingans = $ta2->ta2_Bimbingan()->get();

          return view('mahasiswa.ta2.bimbingan', [
              'mahasiswa' => $mahasiswa,
              'ta2' => $ta2,
              'dosen_pembimbings' => $dosen_pembimbings,
              'bimbingans' => $bimbingans,
          ]);
    }

    /**
     * @param Request $request
     * menyediakan data untuk halaman addBimbingan
     */
    public function addBimbingan(Request $request) {
        //user id
        $user_id = session("user_id");
        $mahasiswa = Mahasiswa::findOrFail($user_id);

        //get ta
        $ta2_id = Mahasiswa::findOrFail($user_id)->current_ta2_id;
        $ta2 = TA2_TA::findOrFail($ta2_id);

        //get semua dosen pembimbing
        $dosen_pembimbings = $ta2->dosen()->get();

        return view('mahasiswa.ta2.add_bimbingan', [
            'mahasiswa' => $mahasiswa,
            'dosen_pembimbings' => $dosen_pembimbings,
        ]);
    }

    /**
     * @param $bimbingan_id
     * menampilkan bimbingan yang tersedia berdasarkan id
     */
    public function isiBimbingan($bimbingan_id) {
        //mahasiswa
        $user_id = session('user_id');
        $mahasiswa = Mahasiswa::findOrFail($user_id);

        //get bimbingan
        $bimbingan = TA2_Bimbingan::find($bimbingan_id);

        //get ta
        $ta2 = TA2_TA::findOrFail($bimbingan->ta_id);

        //get_dosen
        $dosen_pembimbing = Dosen::findOrFail($bimbingan->dosen_id);

        $dosen_pembimbing_2 = null;
        if($bimbingan->dosen_id_2 != null) {
            $dosen_pembimbing_2 = Dosen::findOrFail($bimbingan->dosen_id_2);
        }

        //check apakah user sama
        $user_id = session('user_id');
        $ta_mahasiswa_id = $ta2->mahasiswa_id;

        if ($user_id != $ta_mahasiswa_id) {
            return redirect('mahasiswa/home');
        }

        return view('mahasiswa.ta2.view_bimbingan', [
            'bimbingan' => $bimbingan,
            'dosen_pembimbing' => $dosen_pembimbing,
            'dosen_pembimbing_2' => $dosen_pembimbing_2,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    /**
     * @param Request $request
     * menambahkan bimbingan ke database saat pengguna submit
     */
    public function addBimbinganSubmit(Request $request)
    {
        $request->validate([
            'dosen_pembimbing_id' => 'required',
            'tanggal' => 'required',
            'hasil_diskusi' => 'required',
			'tindak_lanjut' => 'required'
        ]);

        //dapet data untuk disimpan di variabel bimbingan
        $ta_id = TA2_TA::find(Mahasiswa::find(session('user_id'))->current_ta2_id)->ta_id;
        $dosen_id = $request->input('dosen_pembimbing_id');
        $tanggal = DateTime::createFromFormat('Y-m-d', $request->input('tanggal'))->format('Y-m-d');
        $hasil_diskusi = $request->input('hasil_diskusi');
        $tindak_lanjut = $request->input('tindak_lanjut');


        //simpan data di variabel bimbingan
        //bimbingan sudah bisa untuk dua dosen
        $bimbingan = new TA2_Bimbingan;
        $bimbingan->ta_id = $ta_id;
        $bimbingan->dosen_id = $dosen_id[0];

        if(count($dosen_id) > 1) {
            $bimbingan->dosen_id_2 = $dosen_id[1];
        }

        $bimbingan->tanggal = $tanggal;
        $bimbingan->hasil_diskusi = $hasil_diskusi;
        $bimbingan->rencana_tindak_lanjut = $tindak_lanjut;
        $bimbingan->approved = 0;
        $bimbingan->save();

        //pindah ke halaman view bimbingan
        return redirect('mahasiswa/ta2/bimbingan');
    }

    /**
     * @param $bimbingan_id
     * Menampilkan view untuk edit bimbingan dengan id bimbingan_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editBimbingan($bimbingan_id)
    {
        //user
        $user_id = session('user_id');
        $mahasiswa = Mahasiswa::find($user_id);

        //bimbingan
        $bimbingan = TA2_Bimbingan::find($bimbingan_id);

        //Get TA
        $ta2 = TA2_TA::find($bimbingan->ta_id);

        //dosen pembimbing
        $dosen_pembimbing = $ta2->dosen()->get();
        $current_dosen= Dosen::find($bimbingan->dosen_id);

        //tanggal 
        $tanggal_input_format = DateTime::createFromFormat('Y-m-d', $bimbingan->tanggal)->format('Y-m-d');

        //check apakah user sama dengan ta
        if ($user_id != $ta2->mahasiswa_id) {
            return redirect('mahasiswa/home');
        }

        return view('mahasiswa.ta2.edit_bimbingan', [
            'bimbingan' => $bimbingan,
            'mahasiswa' => $mahasiswa,
            'dosen_pembimbings' => $dosen_pembimbing,
            'current_dosen' => $current_dosen,
            'tanggal' => $tanggal_input_format,
        ]);
    }

    /**
     * @param Request $request
     * Melakukan update untuk bimbingan yang telah di edit, kemudian dimasukkan ke database
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editBimbinganSubmit(Request $request) {
        $request->validate([
            'dosen_pembimbing_id' => 'required',
            'tanggal' => 'required',
            'hasil_diskusi' => 'required',
        ]);

        $ta_id = Mahasiswa::find(session('user_id'))->current_ta2_id;
        $dosen_id = $request->input('dosen_pembimbing_id');
        $tanggal = DateTime::createFromFormat('Y-m-d', $request->input('tanggal'))->format('Y-m-d');
        $hasil_diskusi = $request->input('hasil_diskusi');
        $bimbingan_id = $request->input('bimbingan_id');

        //ambil bimbingan dan save setela dimasuan data baru
        $bimbingan = TA2_Bimbingan::find($bimbingan_id);
        $bimbingan->ta_id = $ta_id;

        $bimbingan->dosen_id = $dosen_id[0];
        $bimbingan->dosen_id_2 = null;

        if (sizeof($dosen_id) > 1) {
            $bimbingan->dosen_id_2 = $dosen_id[1];
        }
        $bimbingan->tanggal = $tanggal;
        $bimbingan->hasil_diskusi = $hasil_diskusi;
        $bimbingan->approved = 0;
        $bimbingan->save();

        //redirect ke halaman utama bimbingan
        return redirect('mahasiswa/ta2/bimbingan');
    }

    public function delete($bimbingan_id) {
        //user
        $user_id = session('user_id');

        //find bimbingan
        $bimbingan = TA2_Bimbingan::find($bimbingan_id);

        //Get TA
        $ta2 = TA2_TA::find($bimbingan->ta_id);
        if ($user_id != $ta2->mahasiswa_id) {
            return redirect('mahasiswa/home');
        } else {
            $bimbingan->delete();
        }
        return back();
    }
}
