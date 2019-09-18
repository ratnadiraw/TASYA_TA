<?php

namespace App\Http\Controllers\TimTA\TA2\Sidang;

use App\TA2_BeritaAcaraSidang;
use App\TA2_Progress_Summary;
use App\TA2_Sidang;
use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BeritaAcara extends Controller
{
    public function index() {
        $listOfSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran','>=',5)
            ->where('ta2_sidang.status_pendaftaran', '<', 100)
            ->whereNotNull('tanggal')
            ->whereNotNull('ruangan')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_ta.status_lulus', '=', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_berita_acara_sidang','ta2_sidang.sidang_id','=','ta2_berita_acara_sidang.sidang_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id', 'ta2_berita_acara_sidang.bas_id as bas_id',
                'ta2_progress_summary.ps_id as ps_id', 'ta2_sidang.status_pendaftaran as status_pendaftaran',
                'ta2_ta.judul as judul')
            ->get();

        return view('tim_ta.ta2.sidang.berita_acara_sidang', [
            'listOfSidang' => $listOfSidang,
        ]);
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

        return view('tim_ta.ta2.sidang.view_berita_acara', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function viewBeritaAcaraFinal($sidang_id) {
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

        return view('tim_ta.ta2.sidang.view_berita_acara_final', [
            'berita_acara' => $berita_acara,
            'data_summary' => $data_summary,
            'sidang' => $sidang,
            'dosen_penguji' => $dosen_penguji,
            'dosen_pembimbing' => $dosen_pembimbing,
            'nilai' => $berita_acara->nilai,
        ]);
    }

    public function viewBeritaAcaraSubmit(Request $request) {
        $request->validate([
            'bas_id' => 'required',
            'sidang_id' => 'required',
            'catatan' => 'required',
            'lulus' => 'required'
        ]);

        $bas_id = $request->input('bas_id');
        $berita_acara = TA2_BeritaAcaraSidang::find($bas_id);
        $berita_acara->catatan = $request->input('catatan');




        $sidang = TA2_Sidang::find($request->input('sidang_id'));
        $ta2 = TA2_TA::find($sidang->ta_id);

        //if lulus ta 2
        if ($request->input('lulus') == 1) {
            $ta2->nilai = $berita_acara->nilai;
            $sidang->status_pendaftaran = 6;
            $berita_acara->status_lulus = 1;
        }

        $sidang->save();
        $ta2->save();
        $berita_acara->save();

        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $ta2->ta_id,
        ])->first()->ps_id;

        return redirect('tim_ta/ta2/administrasi/edit_progress_summary/' . $ps_id);
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
