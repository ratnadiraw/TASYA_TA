<?php

namespace App\Http\Controllers\TU\TA2\Sidang;

use App\TA2_BeritaAcaraSidang;
use App\TA2_Progress_Summary;
use App\TA2_Sidang;
use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaAcara extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $listOfSidang = DB::table('ta2_sidang')
            ->whereNotNull('tanggal')
            ->whereNotNull('ruangan')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_ta.status_lulus', '!=', '1')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id',
                'ta2_ta.judul as judul', 'ta2_progress_summary.ps_id as ps_id')
            ->get();
        $data['listOfSidang'] = $listOfSidang;
        return view('tu.ta2.sidang.berita_acara_sidang', $data);
    }


    public function viewBeritaAcara($sidang_id) {
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

        return view('tu.ta2.sidang.add_lampiran_berita_acara_sidang', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
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

        return view('tu.ta2.sidang.view_berita_acara_individual', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function addBeritaAcaraIndividual($sidang_id) {
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

        return view('tu.ta2.sidang.add_berita_acara_individual', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function addBeritaAcaraIndividualSubmit(Request $request) {
        $request->validate([
            'bas_id' => 'required',
            'sidang_id' => 'required',
            'catatan' => 'required',
        ]);

        $bas_id = $request->input('bas_id');
        $berita_acara = TA2_BeritaAcaraSidang::find($bas_id);
        $berita_acara->catatan = $request->input('catatan');
        $berita_acara->save();

        $nilai = $request->input('nilai');
        $berita_acara->nilai = $nilai;

        // Ubah status sidang dan ta
        $sidang = TA2_Sidang::find($berita_acara->sidang_id);
        $ta2 = TA2_TA::find($sidang->ta_id);

        $lulus_sidang = $request->input('button_berita_acara');
        if($lulus_sidang == 1) {
            $ta2->lulus_seminar = 1;
            $sidang->status_pendaftaran = 5;
        } else if ($lulus_sidang == 0) {
            $sidang->status_pendaftaran = 100;
            $ta2->mahasiswa_daftar_sidang = 0;
        }


        //file
        if ($request->file('file_berita_acara') != null) {
            $file_berita_acara = $request->file('file_berita_acara');
            $berita_acara->berita_acara = base64_encode(
                file_get_contents($file_berita_acara->getRealPath())
            );
        }

        if ($request->file('file_lembar_finalisasi') != null) {
            $file_berita_acara = $request->file('file_lembar_finalisasi');
            $berita_acara->lembar_finalisasi = base64_encode(
                file_get_contents($file_berita_acara->getRealPath())
            );
        }

        $ta2->save();
        $sidang->save();
        $berita_acara->save();

        //ps
        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $ta2->ta_id,
        ])->first()->ps_id;

        return redirect('tu/ta2/administrasi/edit_progress_summary/' . $ps_id);
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
