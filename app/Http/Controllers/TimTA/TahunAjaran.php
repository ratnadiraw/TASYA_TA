<?php

namespace App\Http\Controllers\TimTA;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaran extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $listOfTahunAjaran = DB::table('tahun_ajaran')
            ->get();
        $data['listOfTahunAjaran'] = $listOfTahunAjaran;
        return view('tim_ta.tahun_ajaran', $data);
    }

    public function addNewTahunAjaran(Request $request)
    {
        $request->validate([
            'semester' => 'required',
            'year' => 'required',
            'start-date' => 'required|date',
            'end-date' => 'required|date'
        ]);
        $semester = $request->input('semester');
        $year = $request->input('year');
        $start_date = $request->input('start-date');
        $end_date = $request->input('end-date');
        if (strtotime($end_date) < strtotime($start_date)) {
            return Redirect::back()->withErrors('Tanggal Berakhir tidak boleh lebih awal dari Tanggal Mulai');
        }
        DB::table('tahun_ajaran')
            ->insert([
                'semester' => $semester,
                'tahun' => $year,
                'tanggal_mulai' => $start_date,
                'tanggal_selesai' => $end_date,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        return redirect('/tim_ta/tahun_ajaran');
    }

    public function editTahunAjaran($id)
    {
        $data['tahunAjaran'] = DB::table('tahun_ajaran')
            ->where('id', $id)
            ->first();
        return view('tim_ta.edit_tahun_ajaran', $data);
    }
    public function updateTahunAjaran(Request $request)
    {
        $id = $request->input('id');
        $request->validate([
            'semester' => 'required|integer ',
            'year' => 'required',
            'start-date' => 'required|date',
            'end-date' => 'required|date'
        ]);

        DB::table('tahun_ajaran')
            ->where('id', $id)
            ->update([
                'semester' => $request->input('semester'),
                'tahun' => $request->input('year'),
                'tanggal_mulai' => $request->input('start-date'),
                'tanggal_selesai' => $request->input('end-date')
            ]);

        return redirect('/tim_ta/tahun_ajaran');
    }
}
