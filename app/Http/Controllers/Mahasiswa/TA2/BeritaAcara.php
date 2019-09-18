<?php
/**
 * Created by PhpStorm.
 * User: wennyyustalim
 * Date: 05/04/18
 * Time: 00.11
 */

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\TA2_BeritaAcara;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaAcara extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getBeritaAcara() {
        $mahasiswa_id = session('user_id');

        $mahasiswa = DB::table('mahasiswa')
            ->where('mahasiswa.user_id', '=', $mahasiswa_id)
            ->first();

        $seminar = DB::table('ta2_seminar')
            ->where('ta2_seminar.status_pendaftaran', '=', 3)
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('ta2_ta.mahasiswa_id', '=', $mahasiswa_id)
            ->first();

        if ($seminar == null) {
            return redirect('/mahasiswa/ta2/home');
        }

        $berita_acara = DB::table('ta2_berita_acara_seminar')
            ->join('ta2_seminar', 'ta2_seminar.seminar_id', '=', 'ta2_berita_acara_seminar.seminar_id')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('ta2_ta.mahasiswa_id', '=', $mahasiswa_id)
            ->first();

        return view('mahasiswa.ta2.lampiran_berita_acara_seminar', [
            'berita_acara' => $berita_acara,
            'mahasiswa' => $mahasiswa,
            'seminar' => $seminar,
        ]);
    }

    public function beritaAcara($seminar_id) {
        $data_summary = DB::table('ta2_seminar')
            ->where('ta2_seminar.seminar_id', '=', $seminar_id)
            ->join('ta2_ta', 'ta2_seminar.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->first();

        $berita_acara = TA2_BeritaAcara::where([
            'seminar_id' => $seminar_id,
        ])->first();

        return view('mahasiswa.ta2.berita_acara_seminar', [
            'data_summary' => $data_summary,
            'berita_acara' => $berita_acara,
        ]);
    }

    public function downloadBeritaAcara($berita_acara_id) {
        $bap = TA2_BeritaAcara::find($berita_acara_id)->berita_acara;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }
}