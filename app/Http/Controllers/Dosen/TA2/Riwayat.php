<?php

namespace App\Http\Controllers\Dosen\TA2;

use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Riwayat extends Controller
{
    public function index($ta_id) {
        $ta2 = TA2_TA::find($ta_id  );

        $seminar = DB::table('ta2_seminar')
            ->where('ta_id', '=', $ta_id)
            ->join('ta2_berita_acara_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
            ->get();

        $sidang = DB::table('ta2_sidang')
            ->where('ta_id', '=', $ta_id)
            ->join('ta2_berita_acara_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_berita_acara_sidang.sidang_id')
            ->get();

        return view('dosen.ta2.progress_summary.view_riwayat', [
            'seminar' => $seminar,
            'sidang' => $sidang,
            'ta2' => $ta2,
        ]);
    }
}
