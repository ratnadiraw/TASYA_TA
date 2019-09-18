<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgressSummaryTA2 extends Controller
{
    public function view_progress_summary(){
        $mahasiswa_id = session('user_id');

        $ta_id = DB::table('ta2_ta')
            ->where('ta2_ta.mahasiswa_id', '=', $mahasiswa_id)
            ->select('ta2_ta.ta_id as ta_id')
            ->first();

        $data_summary = DB::table('ta2_progress_summary')
            ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('mahasiswa.user_id', '=', $mahasiswa_id)
            ->first();

        if ($data_summary == null) {
            return back();
        }

        $bimbingans = DB::table('ta2_bimbingan')
            ->where('ta_id', '=', $data_summary->ta_id)
            ->where('approved', '=', 1)
            ->get();

        $dosens = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_dosen_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('dosen', 'ta2_dosen_ta.dosen_id', '=' , 'dosen.user_id')
            ->select('dosen.user_id as dosen_id ', 'dosen.nama as nama', 'ta2_ta.ta_id as ta_id')
            ->get();

        $seminar_pending = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=' , $data_summary->ta_id)
            ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('status_pendaftaran', '<', '3')
            ->first();

        $mahasiswa_daftar_seminar = $data_summary->mahasiswa_daftar_seminar == 1;

        $ada_seminar = false;
        if($seminar_pending != null) {
            $ada_seminar = true;
        }

        $lulus_seminar = false;
        $seminar_done = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('status_pendaftaran', '=', '3')
            ->first();

        if ($seminar_done != null) {
            $lulus_seminar = true;
        }

        $mahasiswa_daftar_sidang = $data_summary->mahasiswa_daftar_sidang == 1;

        $ada_sidang = false;
        $sidang_pending = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '<', '5')
            ->first();

        if($sidang_pending != null)
            $ada_sidang = true;

        $selesai_sidang = false;
        $sidang_selesai = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '=', '5')
            ->first();

        if($sidang_selesai != null) {
            $selesai_sidang = true;
        }

        $lulus_sidang = false;
        $sidang_lulus = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '=', '6  ')
            ->first();

        if($sidang_lulus != null) {
            $lulus_sidang = true;
        }

        $all_tugas = DB::table('ta2_tugas_mahasiswa')
            ->where('ta2_tugas_mahasiswa.mahasiswa_id', '=', $mahasiswa_id)
            ->join('ta2_tugas', 'ta2_tugas.tugas_id', '=', 'ta2_tugas_mahasiswa.tugas_id')
            ->join('ta2_tugas_kelas', 'ta2_tugas_kelas.tugas_id', '=', 'ta2_tugas_mahasiswa.tugas_id')
            ->join('ta2_kelas', 'ta2_kelas.kelas_id', '=', 'ta2_tugas_kelas.kelas_id')
            ->get();

        $all_kelas_mahasiswa = DB::table('ta2_mahasiswa_kelas')
            ->where('ta2_mahasiswa_kelas.mahasiswa_id', '=', $mahasiswa_id)
            ->join('ta2_kelas', 'ta2_kelas.kelas_id', '=', 'ta2_mahasiswa_kelas.kelas_id')
            ->orderBy('ta2_mahasiswa_kelas.kelas_id', 'desc')
            ->get();

        return view('mahasiswa.ta2.view_progress_summary', [
            'dosens' => $dosens,
            'data_summary' => $data_summary,
            'bimbingans' => $bimbingans,
            'tugass' => [],
            'mahasiswa_daftar_seminar' => $mahasiswa_daftar_seminar,
            'ada_seminar' => $ada_seminar,
            'seminar_pending' => $seminar_pending,
            'seminar_done' => $seminar_done,
            'lulus_seminar' => $lulus_seminar,
            'mahasiswa_daftar_sidang' => $mahasiswa_daftar_sidang,
            'ada_sidang' => $ada_sidang,
            'sidang_pending' => $sidang_pending,
            'selesai_sidang' => $selesai_sidang,
            'sidang_selesai' => $sidang_selesai,
            'lulus_sidang' => $lulus_sidang,
            'sidang_lulus' => $sidang_lulus,
            'all_tugas' => $all_tugas,
            'all_kelas_mahasiswa' => $all_kelas_mahasiswa,
        ]);

    }

    public function daftar_seminar(Request $request) {
        $request->validate([
            'ta_id' => 'required'
        ]);

        $ta_id = $request->input('ta_id');
        $ta2 = TA2_TA::find($ta_id);
        $ta2->mahasiswa_daftar_seminar = 1;
        $ta2->save();

        return back();
    }

    public function daftar_sidang(Request $request) {
        $request->validate([
            'ta_id' => 'required'
        ]);

        $ta_id = $request->input('ta_id');
        $ta2 = TA2_TA::find($ta_id);
        $ta2->mahasiswa_daftar_sidang = 1;
        $ta2->save();

        return back();
    }

    public function rubah_judul(Request $request) {
        $request->validate([
           'ta_id' => 'required',
           'judul' => 'required',
        ]);

        $ta2_id = $request->input('ta_id');
        $ta2 = TA2_TA::find($ta2_id);

        $ta2->judul = $request->input('judul');
        $ta2->save();

        return back();
    }
}
