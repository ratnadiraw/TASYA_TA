<?php

namespace App\Http\Controllers\TU\TA2\Finalisasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Finalisasi extends Controller
{
    public function index() {
        $listOfSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran', '=', 6)
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_ta.status_lulus', '!=', '1')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id',
                'ta2_ta.judul as judul', 'ta2_progress_summary.ps_id as ps_id')
            ->get();
        $data['listOfSidang'] = $listOfSidang;
        return view('tu.ta2.finalisasi.finalisasi', $data);
    }
}
