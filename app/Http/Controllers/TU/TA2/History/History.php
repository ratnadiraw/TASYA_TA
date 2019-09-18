<?php

namespace App\Http\Controllers\TU\TA2\History;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class History extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$all_progress_summary = DB::table('ta2_ta')
			->where('ta2_ta.status_lulus', '>=', '1')
			->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
			->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
			->join('tahun_ajaran', 'ta2_ta.tahun_ajaran_id', '=', 'tahun_ajaran.id')
			->select('ta2_progress_summary.ps_id as id', 'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
					 'tahun_ajaran.semester as semester', 'tahun_ajaran.tahun as tahun', 'ta2_ta.topik as topik')
			->get();

		return view('tu.ta2.history.history', [
			'all_progress_summary' => $all_progress_summary
		]);
	}

	public function show($ps_id)
	{
		$data_summary = DB::table('ta2_progress_summary')
			->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
			->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
			->where('ta2_progress_summary.ps_id', '=', $ps_id)
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
			->where('status_pendaftaran', '<', 3)
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
			->where('ta2_sidang.status_pendaftaran', '<', '4')
			->first();

		if($sidang_pending != null) {
			$ada_sidang = true;
		}

		$selesai_sidang = false;
		$sidang_selesai = DB::table('ta2_ta')
			->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
			->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
			->where('ta2_sidang.status_pendaftaran', '=', '5')
			->first();
		if ($sidang_selesai != null) {
			$selesai_sidang = true;
		}

		$lulus_sidang = false;
		$sidang_lulus = DB::table('ta2_ta')
			->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
			->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
			->where('ta2_sidang.status_pendaftaran', '=', '6')
			->first();

		if($sidang_lulus != null) {
			$lulus_sidang = true;
		}

		$mahasiswa_id = DB::table('ta2_ta')
			->where('ta_id', '=', $data_summary->ta_id)
			->first()->mahasiswa_id;

		$all_tugas_mahasiswa = DB::table('ta2_tugas_mahasiswa')
			->where('ta2_tugas_mahasiswa.mahasiswa_id', '=', $mahasiswa_id)
			->join('ta2_tugas', 'ta2_tugas.tugas_id', '=', 'ta2_tugas_mahasiswa.tugas_id')
			->get();

		return view('tu.ta2.history.show_progress_summary', [
			'dosens' => $dosens,
			'data_summary' => $data_summary,
			'bimbingans' => $bimbingans,
			'tugass' => [],
			'seminar_pending' => $seminar_pending,
			'seminar_done' => $seminar_done,
			'mahasiswa_daftar_seminar' => $mahasiswa_daftar_seminar,
			'ada_seminar' => $ada_seminar,
			'lulus_seminar' => $lulus_seminar,
			'sidang_pending' => $sidang_pending,
			'sidang_selesai' => $sidang_selesai,
			'selesai_sidang' => $selesai_sidang,
			'mahasiswa_daftar_sidang' => $mahasiswa_daftar_sidang,
			'ada_sidang' => $ada_sidang,
			'lulus_sidang' => $lulus_sidang,
			'sidang_lulus' => $sidang_lulus,
			'all_tugas_mahasiswa' => $all_tugas_mahasiswa
		]);
	}
}