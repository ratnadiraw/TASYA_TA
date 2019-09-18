<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class History extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'displayPengumuman']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listOfTahunAjaran = DB::table('tahun_ajaran')
            ->get();
        $data['listOfTahunAjaran'] = $listOfTahunAjaran;
        return view('tim_ta.ta1.administrasi.history', $data);
    }

    public function indexDetail($tahun_ajaran_id)
    {
        $listOfTahunAjaran = DB::table('tahun_ajaran')
            ->get();
        $data['listOfTahunAjaran'] = $listOfTahunAjaran;
        
        $tahunAjaran = DB::table('tahun_ajaran')
            ->where('id', $tahun_ajaran_id)
            ->first();
        $data['tahunAjaran'] = $tahunAjaran;

        $data['listOfCheckoutTA'] = DB::table('ta1_tugas_akhir')
            ->where('ta1_tugas_akhir.status_checkout', 1)
            ->where('ta1_tugas_akhir.tahun_ajaran_id', $tahun_ajaran_id)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->join('ta1_seminar', 'ta1_seminar.ta_id', '=', 'ta1_tugas_akhir.id')
            ->join('ta1_progress_summary', 'ta1_progress_summary.ta_id', '=', 'ta1_tugas_akhir.id')
            ->select('mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.angkatan', 'ta1_progress_summary.status_lulus',
                'ta1_progress_summary.nilai_akhir', 'ta1_seminar.judul')
            ->get();
        return view('tim_ta.ta1.administrasi.detail_history', $data);
    }
}
