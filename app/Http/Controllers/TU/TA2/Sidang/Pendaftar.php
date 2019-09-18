<?php

namespace App\Http\Controllers\TU\TA2\Sidang;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Pendaftar extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $listOfSidangTaId = DB::table('ta2_sidang')
            ->select('ta2_sidang.ta_id')
            ->pluck('ta_id');

        $listOfPendaftar = DB::table('mahasiswa')
            ->join('ta2_ta', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->where('ta2_ta.mahasiswa_daftar_sidang', '=', '1')
            ->whereNotIn('ta2_ta.ta_id', $listOfSidangTaId)
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_progress_summary.ps_id as ps_id')
            ->get();

        $data['listOfPendaftar'] = $listOfPendaftar;

        return view('tu.ta2.sidang.pendaftar', $data);
    }
}
