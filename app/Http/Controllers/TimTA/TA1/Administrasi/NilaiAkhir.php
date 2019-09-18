<?php

namespace App\Http\Controllers\TimTA\TA1\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiAkhir extends Controller
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
        if (config('constants.ta1.flow_system.enable_hide_finalisasi') == 1) {
            $listOfNilaiAkhir = DB::table('ta1_seminar')
                ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
                ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
                ->join('ta1_progress_summary', 'ta1_tugas_akhir.id', '=', 'ta1_progress_summary.ta_id')
                ->where('ta1_tugas_akhir.status_checkout', 0)
                ->where('ta1_seminar.final', 1)
                ->select('mahasiswa.nama', 'mahasiswa.nim', 'ta1_seminar.id as seminar_id', 'ta1_seminar.ta_id',
                    'ta1_seminar.nilai', 'ta1_tugas_akhir.nama_topik', 'ta1_tugas_akhir.status_checkout',
                    'ta1_progress_summary.jumlah_kehadiran_seminar', 'ta1_progress_summary.jumlah_bimbingan',
                    'ta1_progress_summary.jumlah_kehadiran_kelas', 'ta1_progress_summary.id as progress_id',
                    'ta1_seminar.nilai_pembimbing', 'ta1_seminar.nilai_penguji')
                ->get();
        } else {
            $listOfNilaiAkhir = DB::table('ta1_seminar')
                ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
                ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
                ->join('ta1_progress_summary', 'ta1_tugas_akhir.id', '=', 'ta1_progress_summary.ta_id')
                ->where('ta1_seminar.final', 1)
                ->select('mahasiswa.nama', 'mahasiswa.nim', 'ta1_seminar.id as seminar_id', 'ta1_seminar.ta_id',
                    'ta1_seminar.nilai', 'ta1_tugas_akhir.nama_topik', 'ta1_tugas_akhir.status_checkout',
                    'ta1_progress_summary.jumlah_kehadiran_seminar', 'ta1_progress_summary.jumlah_bimbingan',
                    'ta1_progress_summary.jumlah_kehadiran_kelas', 'ta1_progress_summary.id as progress_id',
                    'ta1_seminar.nilai_pembimbing', 'ta1_seminar.nilai_penguji')
                ->get();
        }
        if (count($listOfNilaiAkhir) > 0) {
            foreach ($listOfNilaiAkhir as $nilaiAkhir) {
                $data['tugas_'.$nilaiAkhir->progress_id] = DB::table('ta1_daftar_tugas')
                    ->where('progress_id', $nilaiAkhir->progress_id)
                    ->where('status_pengumpulan', 1)
                    ->count();
            }
        }
        $data['listOfNilaiAkhir'] = $listOfNilaiAkhir;
        return view('tim_ta.ta1.administrasi.finalisasi_nilai_akhir', $data);
    }

    public function finalize(Request $request)
    {
        $scores = $request->input('score');
        $pembimbingScores = $request->input('pembimbing-score');
        $pengujiScores = $request->input('penguji-score');
        $seminarIds = $request->input('seminar-id');
        $progressIds = $request->input('progress-id');
        $attendanceSum = $request->input('jumlah-kehadiran');
        $taskSum = $request->input('jumlah-tugas');
        $seminarSum = $request->input('jumlah-seminar');
        $bimbinganSum = $request->input('jumlah-bimbingan');

        $taIds = $request->input('ta-id');

        $request->validate([
            'pembimbing-score.*' => 'nullable|alpha',
            'penguji-score.*' => 'nullable|alpha',
            'score.*' => 'nullable|alpha'
        ]);
        if (count($seminarIds) > 0) {
            $counter = 0;
            foreach ($seminarIds as $seminarId) {
                if (config('constants.ta1.nilai_akhir.cek_tugas') == 1) {
                    $jumlahTugasMahasiswa = DB::table('ta1_daftar_tugas')
                        ->where('progress_id', $progressIds[$counter])
                        ->count();
                } else {
                    $jumlahTugasMahasiswa = 0;
                }
                if ($attendanceSum[$counter] + $bimbinganSum[$counter] >= config('constants.ta1.nilai_akhir.syarat_kehadiran')
                    && $seminarSum[$counter] >= config('constants.ta1.nilai_akhir.jumlah_kehadiran_seminar') && $taskSum[$counter] >= $jumlahTugasMahasiswa) {
                    DB::table('ta1_seminar')
                        ->where('id', $seminarId)
                        ->update([
                            'nilai_pembimbing' => $pembimbingScores[$counter],
                            'nilai_penguji' => $pengujiScores[$counter],
                            'nilai' => $scores[$counter]
                        ]);
                    if ($scores[$counter] == 'D' or $scores[$counter] == 'E') {
                        DB::table('ta1_progress_summary')
                            ->where('ta_id', $taIds[$counter])
                            ->update([
                                'status_lulus' => 0,
                                'nilai_akhir' => $scores[$counter]
                            ]);
                    } elseif (isset($scores[$counter])) {
                        DB::table('ta1_progress_summary')
                            ->where('ta_id', $taIds[$counter])
                            ->update([
                                'status_lulus' => 1,
                                'nilai_akhir' => $scores[$counter]
                            ]);
                    }

                    $status = ($request->input('checkout-'.$seminarId)) !== null;
                    if ($status) {
                        DB::table('ta1_tugas_akhir')
                            ->where('id', $taIds[$counter])
                            ->update([
                                'status_checkout' => true
                            ]);
                    } else {
                        DB::table('ta1_tugas_akhir')
                            ->where('id', $taIds[$counter])
                            ->update([
                                'status_checkout' => false
                            ]);
                    }
                }
                $counter++;
            }
        }
        return back();
    }
}
