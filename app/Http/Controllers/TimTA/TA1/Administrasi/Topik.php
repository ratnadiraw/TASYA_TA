<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Topik extends Controller
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
        $listOfTopics = DB::table('ta1_dosen_ta')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_dosen_ta.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('topik', 'topik.topik_id', '=', 'ta1_tugas_akhir.topik_id')
            ->join('dosen as dosen1', 'dosen1.user_id', '=', 'topik.pembimbing1_id')
            ->leftJoin('dosen as dosen2', 'dosen2.user_id', '=', 'topik.pembimbing2_id')
            ->select('topik.topik_id as topik_id', 'topik.nama as nama_topik', 'dosen1.nama as nama_dosen1', 'dosen2.nama as nama_dosen2')
            ->distinct()
            ->get();
        $data['listOfTopics'] = $listOfTopics;

        foreach ($listOfTopics as $topic) {
            $listOfMahasiswa = DB::table('ta1_tugas_akhir')
                ->where('topik_id', $topic->topik_id)
                ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
                ->where('ta1_tugas_akhir.status_checkout', 0)
                ->select('mahasiswa.nama as nama_mahasiswa', 'mahasiswa.nim as nim_mahasiswa')
                ->distinct()
                ->get();

            $data['mahasiswa'.$topic->topik_id] = $listOfMahasiswa;
        }
        return view('tim_ta.ta1.administrasi.daftar_topik', $data);
    }
}
