<?php

namespace App\Http\Controllers\TimTA\TA2\Kelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Kelas extends Controller
{
    public function index()
    {
        $all_kelas = DB::table('ta2_kelas')
			->where('ta2_kelas.status_kelas', '=', 0)
            ->select('ta2_kelas.kelas_id as id', 'ta2_kelas.tahun as tahun', 'ta2_kelas.semester as semester')
            ->get();

        $kelas_reverse = [];
        $count = count($all_kelas);
        for($idx = $count - 1; $idx >= 0; $idx--) array_push($kelas_reverse, $all_kelas[$idx]);
		
        return view('tim_ta.ta2.kelas.kelasTA2', [
            'all_kelas' => $kelas_reverse
        ]);
    }

    public function tugas($tahun, $semester)
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
			->select('ta2_tugas.tugas_id as id', 'ta2_tugas.deadline as deadline', 'ta2_tugas.judul as judul', 'ta2_tugas.path as path')
			->get();

		return view('tim_ta.ta2.kelas.tugas', [
			'all_tugas' => $all_tugas,
			'tahun' => $tahun,
			'semester' => $semester
		]);
	}

    public function upload($tahun, $semester, Request $request)
	{
		$judul = $request['tugas'];
		$deadline = $request['deadline'];

		$file = $request->file('pdf');
		$name = $file->getClientOriginalName();

		$path = Storage::putFileAs('tugas/'. $tahun . '/' . $semester, $file, $name, 'private');

		$tugas_id = DB::table('ta2_tugas')->insertGetId([
			'deadline' => Carbon::parse($deadline),
			'judul' => $judul,
			'path' => $path
		]);

		$kelas_id = DB::table('ta2_kelas')
			->where('ta2_kelas.tahun', '=', $tahun)
			->where('ta2_kelas.semester', '=', $semester)
			->select('ta2_kelas.kelas_id as id')
			->first()
			->id;

		DB::table('ta2_tugas_kelas')->insert([
			'tugas_id' => $tugas_id,
			'kelas_id' => $kelas_id,
		]);

		$all_mahasiswa = DB::table('ta2_mahasiswa_kelas')
			->where('ta2_mahasiswa_kelas.kelas_id', '=', $kelas_id)
			->select('ta2_mahasiswa_kelas.mahasiswa_id as id')
			->get();

		foreach($all_mahasiswa as $mahasiswa)
		{
			DB::table('ta2_tugas_mahasiswa')->insert([
				'tugas_id' => $tugas_id,
				'mahasiswa_id' => $mahasiswa->id,
				'sudah_dinilai' => false
			]);
		}

		return redirect('/tim_ta/ta2/kelas/tugas/'. $tahun . '/' . $semester);
	}

	public function preview($tahun, $semester, $tugas_id, $filename, Request $request)
	{
		$path = DB::table('ta2_tugas')
			->where('ta2_tugas.tugas_id', '=', $tugas_id)
			->select('ta2_tugas.path as path')
			->first()
			->path;

		return response()->file(storage_path( 'app/' . $path), [
			'Content-Type' => Storage::mimeType($path)
		]);
	}
}
