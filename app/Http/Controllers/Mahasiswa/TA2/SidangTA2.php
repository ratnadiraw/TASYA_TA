<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\Mahasiswa;
use App\TA2_BeritaAcaraSidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SidangTA2 extends Controller
{
    public function viewSidang($sidang_id) {
        $dataSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id','=',$sidang_id)
            ->join('ta2_ta', 'ta2_sidang.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_sidang.sidang_id as sidang_id', 'ta2_sidang.tanggal as tanggal',
                'ta2_sidang.ruangan as ruangan')
            ->first();

        //data dosen penguji
        $dosenPenguji = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_dosen_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_dosen_sidang.sidang_id')
            ->join('dosen', 'ta2_dosen_sidang.dosen_id', '=', 'dosen.user_id')
            ->select('dosen.nama as nama', 'dosen.user_id as dosen_id')
            ->get();

        echo $sidang_id . '<br>';
        foreach($dosenPenguji as $dosen) {
            echo $dosen->nama . '<br>';
        }
        return view('mahasiswa.ta2.view_sidang', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }


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

        return view('mahasiswa.ta2.sidang.view_berita_acara_sidang_individual', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function downloadBeritaAcara($bas_id) {
//      echo $berita_acara_id . '<br>';
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

    public function getSidang() {
        $mahasiswa = Mahasiswa::find(session('user_id'));

        $data_sidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran', '<', '4')
            ->join('ta2_ta', 'ta2_sidang.ta_id', '=', 'ta2_ta.ta_id')
            ->where('ta2_ta.mahasiswa_id', '=', session('user_id'))
            ->where('ta2_ta.status_lulus', '=', 0)
            ->select('ta2_ta.mahasiswa_id as mahasiswa_id', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal')
            ->first();
        if ($data_sidang == null) {
            abort(403);
        }

        return view('mahasiswa.ta2.sidang', [
            'data_sidang' => $data_sidang,
            'mahasiswa' => $mahasiswa,
        ]);
    }
}
