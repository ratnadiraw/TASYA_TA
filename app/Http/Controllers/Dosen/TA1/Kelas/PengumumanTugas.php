<?php

namespace App\Http\Controllers\Dosen\TA1\Kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanTugas extends Controller
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
    public function announcement()
    {
        return view('dosen.ta1.kelas.pengumuman_tugas');
    }

    public function listOfAnnouncement()
    {
        return view('dosen.ta1.kelas.daftar_pengumuman_tugas');
    }
}
