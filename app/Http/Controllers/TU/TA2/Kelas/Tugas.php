<?php

namespace App\Http\Controllers\TU\TA2\Kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tugas extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index($tahun, $semester)
	{
		$kelas_id = DB::table('ta2_kelas')
			->where('ta2_kelas.tahun', '=', $tahun)
			->where('ta2_kelas.semester', '=', $semester)
			->select('ta2_kelas.kelas_id as id')
			->first()
			->id;

		$all_tugas = DB::table('ta2_tugas_kelas')
			->where('ta2_tugas_kelas.kelas_id', '=', $kelas_id)
			->join('ta2_tugas', 'ta2_tugas_kelas.tugas_id', '=', 'ta2_tugas.tugas_id')
			->select('ta2_tugas.tugas_id as id', 'ta2_tugas.deadline as deadline', 'ta2_tugas.judul as judul')
			->get();

		return view('tu.ta2.kelas.tugas', [
			'all_tugas' => $all_tugas,
			'tahun' => $tahun,
			'semester' => $semester
		]);
	}

	public function checklist($tahun, $semester, $tugas_id)
	{
		$all_tugas_mahasiswa = DB::table('ta2_tugas_mahasiswa')
			->where('ta2_tugas_mahasiswa.tugas_id', '=', $tugas_id)
			->join('mahasiswa', 'ta2_tugas_mahasiswa.mahasiswa_id', '=', 'mahasiswa.user_id')
			->select('ta2_tugas_mahasiswa.tugas_mahasiswa_id as id', 'ta2_tugas_mahasiswa.sudah_dinilai as sudah_dinilai',
					 'mahasiswa.nama as nama', 'mahasiswa.nim as nim')
			->get();

		$tugas = DB::table('ta2_tugas')
			->where('ta2_tugas.tugas_id', '=', $tugas_id)
			->first();

		return view('tu.ta2.kelas.checklist', [
			'all_tugas_mahasiswa' => $all_tugas_mahasiswa,
			'tugas' => $tugas
		]);
	}

	public function update($tahun, $semester, $tugas_id, Request $request)
	{
		DB::table('ta2_tugas_mahasiswa')
			->where('ta2_tugas_mahasiswa.tugas_id', '=', $tugas_id)
			->update(['sudah_dinilai' => 0]);

		$sudah_dinilai = $request['sudah_dinilai'];

		if(!empty($sudah_dinilai))
		{
			foreach ($sudah_dinilai as $tugas_mahasiswa_id) {
				DB::table('ta2_tugas_mahasiswa')
					->where('ta2_tugas_mahasiswa.tugas_mahasiswa_id', '=', $tugas_mahasiswa_id)
					->update(['sudah_dinilai' => 1]);
			}
		}

		return redirect('/tu/ta2/kelas/tugas/'. $tahun . '/' . $semester . '/' . $tugas_id);
	}
}