<?php

namespace App\Http\Controllers\TU\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TA1_ProgressSummary;
use App\TA1_Tugas;
use App\TA1_Tugas_Akhir;
use App\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProgressSummary extends Controller
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
        $summarys = DB::table('ta1_progress_summary')
            ->join('ta1_tugas_akhir', 'ta1_progress_summary.ta_id', '=', 'ta1_tugas_akhir.id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->orderBy('mahasiswa.nim', 'asc')
            ->get();

        $data['summarys'] = $summarys;
        return view('tu.ta1.administrasi.daftar_progress_summary', $data);
    }

    public function editIndex($id)
    {
        $summary = DB::table('ta1_progress_summary')
            ->join('ta1_tugas_akhir', 'ta1_progress_summary.ta_id', '=', 'ta1_tugas_akhir.id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->where('ta1_progress_summary.id', $id)
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'mahasiswa.angkatan as angkatan',
                'ta1_progress_summary.jumlah_kehadiran_kelas as jumlah_kehadiran_kelas',
                'ta1_progress_summary.jumlah_kehadiran_seminar as jumlah_kehadiran_seminar',
                'ta1_progress_summary.id as id', 'ta1_tugas_akhir.nama_topik as nama_topik',
                'ta1_tugas_akhir.id as ta_id', 'ta1_progress_summary.jumlah_bimbingan as jumlah_bimbingan',
                'ta1_progress_summary.status_pengumpulan_dokumen as status_pengumpulan',
                'ta1_progress_summary.id as progress_id')
            ->first();

        $dosen = DB::table('ta1_tugas_akhir')
            ->where('id', $summary->ta_id)
            ->join('ta1_dosen_ta', 'ta1_dosen_ta.ta_id', '=', 'ta1_tugas_akhir.id')
            ->join('dosen', 'dosen.user_id', '=', 'ta1_dosen_ta.dosen_id')
            ->get();

        $daftartugas = DB::table('ta1_daftar_tugas')
            ->where('progress_id', $id)
            ->join('ta1_tugas', 'ta1_tugas.id', '=', 'ta1_daftar_tugas.tugas_id')
            ->get();
        $seminarData = DB::table('ta1_seminar')
            ->where('ta_id', $summary->ta_id)
            ->first();

        $data['summary'] = $summary;
        $data['dosens'] = $dosen;
        $data['tugass'] = $daftartugas;
        $data['seminar'] = $seminarData;
        return view('tu.ta1.administrasi.edit_progress_summary', $data);
    }

    public function update($id)
    {
        $classAttendance = Input::get('kehadiran_kelas');
        $seminarAttendance = Input::get('kehadiran_seminar');
        if (null !== Input::get('laporan')) {
            $submitStatusLaporan = true;
        } else {
            $submitStatusLaporan = false;
        }

        // Validation
        $rules = [
            'kehadiran_kelas' => 'required|integer',
            'kehadiran_seminar' => 'required|integer'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        DB::table('ta1_progress_summary')
            ->where('id', $id)
            ->update([
                'jumlah_kehadiran_kelas' => $classAttendance,
                'jumlah_kehadiran_seminar' => $seminarAttendance,
                'status_pengumpulan_dokumen' => $submitStatusLaporan
            ]);

        return redirect('tu/ta1/administrasi/daftar_progress_summary');
    }

    public function finalizeSeminar(Request $request)
    {
        $classAttendance = $request->input('class-attendance');
        $bimbinganAttendance = $request->input('bimbingan-attendance');
        $checkLaporan = null !== $request->input('laporan');
        $taId = $request->input('ta-id');
        $errors = [];
        error_log($bimbinganAttendance);
        if ($checkLaporan &&
            ($bimbinganAttendance + $classAttendance >= config('constants.ta1.seminar.syarat_kehadiran'))) {
            DB::table('ta1_seminar')
                ->where('ta_id', $taId)
                ->update([
                    'final' => true
                ]);
            DB::table('ta1_progress_summary')
                ->where('ta_id', $taId)
                ->update([
                    'terdaftar_seminar' => true
                ]);
        } else {
            array_push($errors, 'Mahasiswa belum memenuhi persyaratan seminar');
        }
        return Redirect::back()->withErrors($errors);
    }

    public function changeTugasStatus(Request $request)
    {
        $taskIds = $request->input('task-id');
        $progressId = $request->input('progress-id');
        $counter = 0;

        foreach ($taskIds as $taskId) {
            if (null !== $request->input('submit-task-status-'.$taskId)) {
                $submitTaskStatus = true;
            } else {
                $submitTaskStatus = false;
            }
            DB::table('ta1_daftar_tugas')
                ->where('tugas_id', $taskId)
                ->where('progress_id', $progressId)
                ->update([
                    'status_pengumpulan' => $submitTaskStatus
                ]);

            $counter++;
        }
        return back();
    }
}
