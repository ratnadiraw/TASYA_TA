<?php

namespace App\Http\Controllers\Dosen\TA2\Bimbingan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MahasiswaBimbingan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dosen_id = session('user_id');


        $all_mahasiswa_data = DB::table('dosen')
            ->join('ta2_dosen_ta', 'dosen.user_id', '=', 'ta2_dosen_ta.dosen_id')
            ->where('dosen.user_id', '=', $dosen_id)
            ->join('ta2_ta', 'ta2_dosen_ta.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->get();


        $all_mahasiswa = [];

        foreach($all_mahasiswa_data as $mahasiswa_data)
        {
            $nama_nim = array(
                $mahasiswa_data->nim,
                $mahasiswa_data->nama
            );

            array_push($all_mahasiswa, $nama_nim);
        }

        return view('dosen.ta2.bimbingan.mahasiswa',[
            'all_mahasiswa' => $all_mahasiswa_data
        ]);
    }
}