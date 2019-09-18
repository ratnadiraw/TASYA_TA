<?php

namespace App\Http\Controllers\Dosen\TA2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dosen;
use Illuminate\Support\Facades\DB;

class ProgressSummaryTA2 extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $dosen_id = session('user_id');

      $list_summary = DB::table('ta2_progress_summary')
          ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
          ->where('ta2_ta.status_lulus', '=', 0)
          ->join('ta2_dosen_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
          ->where('ta2_dosen_ta.dosen_id', '=', $dosen_id)
          ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
          ->paginate(10);

//      foreach ($summarys as $summary) {
//          echo $summary->ps_id . '<br>';
//          echo $summary->nama . '<br>';
//          echo $summary->nim . '<br>';
//      }

      $data['list_summary'] = $list_summary;
      return view('dosen.ta2.progress_summary.list_progress_summary', $data);
  }

  public function view_progress_summary($ps_id)
  {
      $data_summary = DB::table('ta2_progress_summary')
          ->where('ta2_progress_summary.ps_id', '=', $ps_id)
          ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
          ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
          ->where('ta2_ta.status_lulus', '=', 0)
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


      //SIDANG
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

      $mahasiswa_id = DB::table('ta2_ta')
          ->where('ta_id', '=', $data_summary->ta_id)
          ->first()->mahasiswa_id;

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

      return view('dosen.ta2.progress_summary.view_progress_summary', [
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
          'sidang_pending' => $sidang_pending,
          'all_kelas_mahasiswa' => $all_kelas_mahasiswa,
      ]);
  }
}
