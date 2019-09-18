<?php

namespace App\Http\Controllers\TimTA\TA2\Seminar;

use Illuminate\Http\Request;
use App\TA2_BeritaAcara;
use App\TA2_Seminar;
use App\TA2_TA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mahasiswa;
use Carbon\Carbon;

class Pendaftar extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $listOfSeminarTaId = DB::table('ta2_seminar')
            ->select('ta2_seminar.ta_id')
            ->pluck('ta_id');

        $listOfPendaftar = DB::table('mahasiswa')
            ->join('ta2_ta', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->where('ta2_ta.mahasiswa_daftar_seminar', '=', '1')
            ->whereNotIn('ta2_ta.ta_id', $listOfSeminarTaId)
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_progress_summary.ps_id as ps_id')
            ->get();

        $data['listOfPendaftar'] = $listOfPendaftar;

        return view('tim_ta.ta2.seminar.pendaftar', $data);
    }
}
