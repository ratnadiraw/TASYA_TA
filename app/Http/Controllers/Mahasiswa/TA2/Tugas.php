<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Tugas extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function preview($tugas_id)
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