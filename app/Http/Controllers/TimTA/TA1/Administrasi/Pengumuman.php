<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use App\TA1_Pengumuman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Pengumuman extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'displayPengumuman']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['listOfPengumuman'] = DB::table('ta1_pengumuman')
            ->get();
        return view('tim_ta.ta1.administrasi.pengumuman_umum', $data);
    }


    public function addNewPengumuman(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'start-date' => 'required|date',
            'end-date' => 'required|date',
        ]);
        $title = $request->input('title');
        $content = $request->input('content');
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
        if (strtotime($endDate) < strtotime($startDate)) {
            return Redirect::back()->withErrors('Tanggal Berakhir tidak boleh lebih awal dari Tanggal Mulai');
        }
        $timTAId = Auth::user()->id;
        DB::table('ta1_pengumuman')
            ->insert([
                'judul' => $title,
                'konten' => $content,
                'tanggal_mulai' => Carbon::parse($startDate),
                'tanggal_berakhir' => Carbon::parse($endDate),
                'timTA_id' => $timTAId,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        return redirect('/tim_ta/ta1/administrasi/pengumuman_umum');
    }

    public function deletePengumuman(Request $request)
    {
        $announcementId = $request->input('announcement-id');
        DB::table('ta1_pengumuman')
            ->where('id', $announcementId)
            ->delete();
        return redirect('/tim_ta/ta1/administrasi/pengumuman_umum');
    }

    public function displayPengumuman($id) {
        $pengumuman = TA1_Pengumuman::find($id);
        return view('tim_ta.ta1.administrasi.view_pengumuman')->with(['pengumuman' => $pengumuman]);
    }
}
