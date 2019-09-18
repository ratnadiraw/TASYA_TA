<?php

namespace App\Http\Controllers\Mahasiswa\TA1\Seminar;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Seminar extends Controller
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
        $taData = DB::table('ta1_tugas_akhir')
            ->where('mahasiswa_id', Auth::user()->id)
            ->latest()->first();
        if (isset($taData)) {
            $seminarData = DB::table('ta1_seminar')
                ->where('ta_id', $taData->id)
                ->select('id', 'waktu', 'ruangan', 'judul', 'final')
                ->latest()->first();
        } else {
            $seminarData = null;
        }
        $data['seminarSchedule'] = $seminarData;
        $data['taData'] = $taData;
        return view('mahasiswa.ta1.seminar.jadwal_seminar', $data);
    }

    public function registerSeminar(Request $request)
    {
        $request->validate([
            'ta-title' => 'required',
            'ta-id' => 'required'
        ]);
        $titleTA = $request->input('ta-title');
        $taId = $request->input('ta-id');
        $dataSeminar = DB::table('ta1_seminar')
            ->where('ta_id', $taId)
            ->get();
        if (count($dataSeminar) == 0) {
            DB::table('ta1_seminar')
                ->insert([
                    'ta_id' => $taId,
                    'judul' => $titleTA,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            return redirect('/mahasiswa/ta1/seminar/jadwal_seminar');
        } else {
            return Redirect::back()->withErrors(['You already register a seminar please edit your seminar data instead of register a new seminar']);
        }
    }

    public function updateSeminar(Request $request)
    {
        $request->validate([
            'ta-id' => 'required',
            'ta-title-update' => 'required'
        ]);
        $titleTA = $request->input('ta-title-update');
        $taId = $request->input('ta-id');
        DB::table('ta1_seminar')
            ->where('ta_id', $taId)
            ->update([
                'judul' => $titleTA,
                'updated_at' => Carbon::now()
            ]);
        return back();
    }
}
