<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgressSummary extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $summarys = DB::table('ta1_progress_summary')
            ->join('ta1_tugas_akhir', 'ta1_progress_summary.ta_id', '=', 'ta1_tugas_akhir.id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->orderBy('mahasiswa.nim', 'asc')
            ->get();

        $data['summarys'] = $summarys;
        return view('tim_ta.ta1.administrasi.daftar_progress_summary', $data);
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
        return view('tim_ta.ta1.administrasi.edit_progress_summary', $data);
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
        DB::table('ta1_progress_summary')
            ->where('id', $id)
            ->update([
                'jumlah_kehadiran_kelas' => $classAttendance,
                'jumlah_kehadiran_seminar' => $seminarAttendance,
                'status_pengumpulan_dokumen' => $submitStatusLaporan
            ]);

        return back();
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
