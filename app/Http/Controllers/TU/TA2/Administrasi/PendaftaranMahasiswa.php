<?php

namespace App\Http\Controllers\TU\TA2\Administrasi;

use App\Mahasiswa;
use App\TA1_ProgressSummary;
use App\TA1_Tugas_Akhir;
use App\TA2_Dosen_TA;
use App\TA2_Progress_Summary;
use App\TA2_TA;
use App\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PendaftaranMahasiswa extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMahasiswa() {
        //mhs pny ta1 dan dosen pembimbing
        $mahasiswa_ambil_ta1 = DB::table('mahasiswa')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.mahasiswa_id', '=','mahasiswa.user_id')
            ->whereNotNull('ta1_tugas_akhir.topik_id')
            ->join('ta1_progress_summary', 'ta1_tugas_akhir.id', '=', 'ta1_progress_summary.ta_id')
            ->leftJoin('ta2_ta', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('ta1_progress_summary.status_lulus', '=', null)
            ->orWhere('ta1_progress_summary.status_lulus', '=', 1)
            ->select('mahasiswa.user_id as user_id', 'mahasiswa.nama as nama','mahasiswa.nim as nim','mahasiswa.angkatan as angkatan',
                'mahasiswa.jumlah_sks_lulus as jumlah_sks_lulus', 'ta1_tugas_akhir.nama_topik as nama_topik',
                'ta1_progress_summary.status_lulus as status_lulus', 'ta2_ta.ta_id as ta_id', 'ta2_ta.status_lulus as ta2_status_lulus')
            ->get();

        $data_tahun_ajaran = DB::table('tahun_ajaran')
            ->get();

        return view('tu.ta2.Pendaftaran.pendaftaran', [
            'data_mahasiswa' => $mahasiswa_ambil_ta1,
            'data_tahun_ajaran' => $data_tahun_ajaran
            ]);
    }

    public function daftarTA2(Request $request) {
        $mahasiswa_ids = $request->input('mahasiswa_ids');

        foreach($mahasiswa_ids as $mahasiswa_id) {
            $ta_mahasiswa = DB::table('ta2_ta')
                ->where('mahasiswa_id', '=', $mahasiswa_id)
                ->get();

            //kalau belum punya ta
            DB::table('ta2_ta')
                ->where([
                    'mahasiswa_id' => $mahasiswa_id,
                    'status_lulus' => 0,
                ])->delete();

            //data untuk dipakai
            $tahun_ajaran_id = $request->input('tahun_ajaran_' . $mahasiswa_id);

            $dosen_pembimbing = DB::table('mahasiswa')
                ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.mahasiswa_id', '=', 'mahasiswa.user_id')
                ->where('ta1_tugas_akhir.mahasiswa_id', '=', $mahasiswa_id)
                ->join('ta1_dosen_ta', 'ta1_tugas_akhir.id', '=', 'ta1_dosen_ta.ta_id')
                ->join('dosen', 'ta1_dosen_ta.dosen_id', '=', 'dosen.user_id')
                ->select("dosen.user_id as dosen_id", "dosen.nama as nama")
                ->get();

            $ta2 = new TA2_TA;
            $ta2->mahasiswa_id = $mahasiswa_id;
            $ta1 = DB::table('ta1_tugas_akhir')
                ->where('ta1_tugas_akhir.mahasiswa_id', '=', $mahasiswa_id)
                ->first();

            $ta2->topik = $ta1->nama_topik;
            $ta2->tahun_ajaran_id = $tahun_ajaran_id;

            //ambil judul
            $ta1_seminar = DB::table('ta1_seminar')
                ->where('ta_id' ,'=', $ta1->id)
                ->first();

            if ($ta1_seminar != null) {
                $ta2->judul = $ta1_seminar->judul;
            }

            $ta2->save();

            $mahasiswa = Mahasiswa::find($mahasiswa_id);
            $mahasiswa->current_ta2_id = $ta2->ta_id;
            $mahasiswa->save();

            $progress_summary = new TA2_Progress_Summary;
            $progress_summary->ta_id = $ta2->ta_id;
            $progress_summary->save();

            //insert dosen
            foreach ($dosen_pembimbing as $dosbing) {
                $dosen_ta = new TA2_Dosen_TA;
                $dosen_ta->dosen_id = $dosbing->dosen_id;
                $dosen_ta->ta_id = $ta2->ta_id;
                $dosen_ta->save();
            }

        }

        return redirect('/tu/ta2/administrasi/pendaftaran');
    }
}