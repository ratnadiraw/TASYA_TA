<?php

namespace App\Http\Controllers\TimTA\TA2\Administrasi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pengumuman extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$data['listOfPengumuman'] = DB::table('ta2_pengumuman')
			->get();

		return view('tim_ta.ta2.administrasi.pengumuman_umum', $data);
	}

	public function addNewPengumuman(Request $request)
	{
		$title = $request->input('title');
		$content = $request->input('content');
		$startDate = $request->input('start-date');
		$endDate = $request->input('end-date');
		$timTAId = Auth::user()->id;

		DB::table('ta2_pengumuman')
			->insert([
				'judul' => $title,
				'konten' => $content,
				'tanggal_mulai' => Carbon::parse($startDate),
				'tanggal_berakhir' => Carbon::parse($endDate),
				'timTA_id' => $timTAId,
				'created_at' => Carbon::now()->toDateTimeString(),
				'updated_at' => Carbon::now()->toDateTimeString()
			]);

		return redirect('/tim_ta/ta2/administrasi/pengumuman_umum');
	}

	public function deletePengumuman(Request $request)
	{
		$announcementId = $request->input('announcement-id');

		DB::table('ta2_pengumuman')
			->where('id', $announcementId)
			->delete();

		return redirect('/tim_ta/ta2/administrasi/pengumuman_umum');
	}

	public function displayPengumuman($id)
	{
		$pengumuman = DB::table('ta2_pengumuman')
			->where('ta2_pengumuman.id', '=', $id)
			->first();

		return view('tim_ta.ta2.administrasi.view_pengumuman')->with(['pengumuman' => $pengumuman]);
	}
}