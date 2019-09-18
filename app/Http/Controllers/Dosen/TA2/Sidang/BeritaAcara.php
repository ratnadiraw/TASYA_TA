<?php

namespace App\Http\Controllers\Dosen\TA2\Sidang;

use App\TA2_BeritaAcaraSidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaAcara extends Controller
{
    public function viewBeritaAcaraIndividual($sidang_id) {
        $sidang = DB::table('ta2_sidang')
            ->where('sidang_id', '=', $sidang_id)
            ->first();
        if ($sidang == null) {
            return back();
        }

        $dosen_pembimbing = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_ta', 'ta2_sidang.ta_id', '=', 'ta2_ta.ta_id')
            ->join('ta2_dosen_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('dosen', 'ta2_dosen_ta.dosen_id', '=', 'dosen.user_id')
            ->get();

        $dosen_penguji = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_dosen_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_dosen_sidang.sidang_id')
            ->join('dosen', 'ta2_dosen_sidang.dosen_id', '=', 'dosen.user_id')
            ->get();

        $data_summary = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id', 'ta2_ta.topik as topik', 'ta2_ta.judul as judul')
            ->first();

        $berita_acara = DB::table('ta2_berita_acara_sidang')
            ->where('ta2_berita_acara_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_berita_acara_sidang.sidang_id')
            ->first();

        if ($berita_acara == null) {
            $beritaAcara = new TA2_BeritaAcaraSidang;
            $beritaAcara->sidang_id = $sidang_id;
            $beritaAcara->catatan = "";
            $beritaAcara->save();

            $berita_acara = DB::table('ta2_berita_acara_sidang')
                ->where('ta2_berita_acara_sidang.sidang_id', '=', $sidang_id)
                ->join('ta2_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_berita_acara_sidang.sidang_id')
                ->first();
        }

        return view('dosen.ta2.sidang.view_berita_acara_individual', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function downloadBeritaAcara($bas_id) {
//        echo $berita_acara_id . '<br>';
        $bap = TA2_BeritaAcaraSidang::find($bas_id)->berita_acara;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }

    public function downloadLembarFinalisasi($bas_id) {
//        echo $berita_acara_id . '<br>';
        $bap = TA2_BeritaAcaraSidang::find($bas_id)->lembar_finalisasi;

        header("Content-Type: application/pdf");
        echo base64_decode($bap);
    }
}
