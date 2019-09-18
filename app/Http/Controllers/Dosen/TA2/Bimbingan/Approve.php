<?php

namespace App\Http\Controllers\Dosen\TA2\Bimbingan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Approve extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($nim_mahasiswa)
    {
        $dosen_id = session('user_id');
        $all_bimbingan = DB::table('ta2_bimbingan')
            ->join('ta2_ta', 'ta2_bimbingan.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->where('mahasiswa.nim', '=', $nim_mahasiswa)
//            ->where('ta2_bimbingan.dosen_id', '=', $dosen_id)
//            ->orWhere('ta2_bimbingan.dosen_id_2', '=', $dosen_id)
            ->get();

        return view('dosen.ta2.bimbingan.approve',[
            'all_bimbingan' => $all_bimbingan,
            'nim' => $nim_mahasiswa
        ]);
    }

    public function review(Request $request, $nim)
    {
        $dosen_id = session('user_id');
        $bimbingan = DB::table('ta2_bimbingan')
            ->where('ta2_bimbingan.bimbingan_id', '=', $request['id'])
//            ->where('ta2_bimbingan.dosen_id', '=', $dosen_id)
//            ->orWhere('ta2_bimbingan.dosen_id_2', '=', $dosen_id)
            ->first();

        return view('dosen.ta2.bimbingan.review', [
            'bimbingan' => $bimbingan,
            'nim' => $nim
        ]);
    }

    public function approved(Request $request, $nim)
    {
        $dosen_id = session('user_id');
        DB::table('ta2_bimbingan')
            ->where('ta2_bimbingan.bimbingan_id', '=', $request['id'])
//            ->where('ta2_bimbingan.dosen_id', '=', $dosen_id)
//            ->orWhere('ta2_bimbingan.dosen_id_2', '=', $dosen_id)
            ->update([
                'approved' => ($request['button_bimbingan'] == 1)? 1 : 2,
                'komentar' => $request['komentar']
            ]);

        return redirect('dosen/ta2/bimbingan/approve/' . $nim);
    }
    /*
    public function rejected(Request $request, $nim)
    {
        $dosen_id = session('user_id');
        DB::table('ta2_bimbingan')
            ->where('ta2_bimbingan.bimbingan_id', '=', $request['id'])
            ->where('ta2_bimbingan.dosen_id', '=', $dosen_id)
            ->orWhere('ta2_bimbingan.dosen_id_2', '=', $dosen_id)
            ->update([
                'approved' => 2,
                'komentar' => $request['komentar']
            ]);

        return redirect('dosen/ta2/bimbingan/approve/' . $nim);
    }*/
}