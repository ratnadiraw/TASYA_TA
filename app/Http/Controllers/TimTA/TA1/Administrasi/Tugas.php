<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Tugas extends Controller
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
        $listOfTugas = DB::table('ta1_tugas')
            ->get();
        $data['listOfTugas'] = $listOfTugas;
        return view('tim_ta.ta1.administrasi.tugas', $data);
    }

    public function addNewTugas(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'required|date'
        ]);
        $title = $request->input('title');
        $deadline = $request->input('deadline');

        $tugas = DB::table('ta1_tugas')
            ->insertGetId([
                'judul' => $title,
                'tenggat_waktu' => Carbon::parse($deadline),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        $listOfMahasiswaUnchecked = DB::table('ta1_tugas_akhir')
            ->join('ta1_progress_summary', 'ta1_progress_summary.ta_id', '=', 'ta1_tugas_akhir.id')
            ->where('status_checkout', 0)
            ->select('ta1_progress_summary.id as progress_id')
            ->get();

        foreach($listOfMahasiswaUnchecked as $mahasiswa) {
            DB::table('ta1_daftar_tugas')
                ->insert([
                    'tugas_id' => $tugas,
                    'progress_id' => $mahasiswa->progress_id
                ]);
        }

        return redirect('/tim_ta/ta1/administrasi/tugas');
    }

    public function deleteTugas(Request $request)
    {
        $taskId = $request->input('task-id');

        DB::table('ta1_tugas')
            ->where('id', $taskId)
            ->delete();

        DB::table('ta1_daftar_tugas')
            ->where('tugas_id', $taskId)
            ->delete();

        return redirect('/tim_ta/ta1/administrasi/tugas');
    }
}
