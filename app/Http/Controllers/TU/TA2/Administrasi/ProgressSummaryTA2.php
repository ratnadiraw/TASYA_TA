<?php

namespace App\Http\Controllers\TU\TA2\Administrasi;

use App\TA2_Progress_Summary;
use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgressSummaryTA2 extends Controller
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
      $summarys = DB::table('ta2_progress_summary')
          ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
          ->where('ta2_ta.status_lulus', '=', 0)
          ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
          ->paginate(10);

      $data['summarys'] = $summarys;
      return view('tu.ta2.administrasi.daftar_progress_summary', $data);
    }

    public function getAll() {
        $list_summary = DB::table('ta2_progress_summary')
            ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('ta2_ta.status_lulus', '=', 0)
            ->paginate(10);


        return view('tu.ta2.administrasi.daftar_progress_summary', [
            'list_summary' => $list_summary,
        ]);
    }

    public function editProgressSummary($ps_id) {
        $data_summary = DB::table('ta2_progress_summary')
            ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('ta2_progress_summary.ps_id', '=', $ps_id)
            ->where('ta2_ta.status_lulus', '=', 0)->first();

        if ($data_summary == null) {
            return back();
        }

		$bimbingans = DB::table('ta2_bimbingan')
			->where('ta_id', '=', $data_summary->ta_id)
			->where('approved', '=', 1)
			->get();

        $dosens = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_dosen_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('dosen', 'ta2_dosen_ta.dosen_id', '=' , 'dosen.user_id')
            ->select('dosen.user_id as dosen_id ', 'dosen.nama as nama', 'ta2_ta.ta_id as ta_id')
            ->get();

        $seminar_pending = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=' , $data_summary->ta_id)
            ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('status_pendaftaran', '<', 3)
            ->first();

        $mahasiswa_daftar_seminar = $data_summary->mahasiswa_daftar_seminar == 1;

        $ada_seminar = false;
        if($seminar_pending != null) {
            $ada_seminar = true;
        }

        $lulus_seminar = false;
        $seminar_done = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('status_pendaftaran', '=', '3')
            ->first();

        if ($seminar_done != null) {
            $lulus_seminar = true;
        }

        $mahasiswa_daftar_sidang = $data_summary->mahasiswa_daftar_sidang == 1;

        $ada_sidang = false;
        $sidang_pending = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '<', '4')
            ->first();

        if($sidang_pending != null) {
            $ada_sidang = true;
        }

        $selesai_sidang = false;
        $sidang_selesai = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '=', '5')
            ->first();
        if ($sidang_selesai != null) {
            $selesai_sidang = true;
        }

        $lulus_sidang = false;
        $sidang_lulus = DB::table('ta2_ta')
            ->where('ta2_ta.ta_id', '=', $data_summary->ta_id)
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '=', '6')
            ->first();

        if($sidang_lulus != null) {
            $lulus_sidang = true;
        }

        $mahasiswa_id = DB::table('ta2_ta')
            ->where('ta_id', '=', $data_summary->ta_id)
            ->first()->mahasiswa_id;

        $all_tugas_mahasiswa = DB::table('ta2_tugas_mahasiswa')
            ->where('ta2_tugas_mahasiswa.mahasiswa_id', '=', $mahasiswa_id)
            ->join('ta2_tugas', 'ta2_tugas.tugas_id', '=', 'ta2_tugas_mahasiswa.tugas_id')
            ->join('ta2_tugas_kelas', 'ta2_tugas_kelas.tugas_id', '=', 'ta2_tugas_mahasiswa.tugas_id')
            ->join('ta2_kelas', 'ta2_kelas.kelas_id', '=', 'ta2_tugas_kelas.kelas_id')
            ->get();

        $all_kelas_mahasiswa = DB::table('ta2_mahasiswa_kelas')
            ->where('ta2_mahasiswa_kelas.mahasiswa_id', '=', $mahasiswa_id)
            ->join('ta2_kelas', 'ta2_kelas.kelas_id', '=', 'ta2_mahasiswa_kelas.kelas_id')
            ->orderBy('ta2_mahasiswa_kelas.kelas_id', 'desc')
            ->get();


         return view('tu.ta2.administrasi.edit_progress_summary', [
             'dosens' => $dosens,
             'data_summary' => $data_summary,
             'bimbingans' => $bimbingans,
             'tugass' => [],
             'seminar_pending' => $seminar_pending,
             'seminar_done' => $seminar_done,
             'mahasiswa_daftar_seminar' => $mahasiswa_daftar_seminar,
             'ada_seminar' => $ada_seminar,
             'lulus_seminar' => $lulus_seminar,
             'sidang_pending' => $sidang_pending,
             'sidang_selesai' => $sidang_selesai,
             'selesai_sidang' => $selesai_sidang,
             'mahasiswa_daftar_sidang' => $mahasiswa_daftar_sidang,
             'ada_sidang' => $ada_sidang,
             'lulus_sidang' => $lulus_sidang,
             'sidang_lulus' => $sidang_lulus,
             'all_tugas_mahasiswa' => $all_tugas_mahasiswa,
             'all_kelas_mahasiswa' => $all_kelas_mahasiswa,
         ]);
    }

    public function editProgressSummarySubmit(Request $request) {
        $request->validate([
            'ps_id' => 'required',
            'jumlah_kehadiran_kelas' => 'required',
            'jumlah_kehadiran_seminar' => 'required',
        ]);

        $progress_summary = TA2_Progress_Summary::find($request->input('ps_id'));
        $progress_summary->jumlah_kehadiran_kelas = $request->input('jumlah_kehadiran_kelas');
        $progress_summary->jumlah_kehadiran_seminar = $request->input('jumlah_kehadiran_seminar');
        $progress_summary->save();

        $data_summary = DB::table('ta2_progress_summary')
            ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('ta2_progress_summary.ps_id', '=', $progress_summary->ps_id)
            ->where('ta2_ta.status_lulus', '=', 0)->first();


        $mahasiswa_id = DB::table('ta2_ta')
            ->where('ta_id', '=', $data_summary->ta_id)
            ->first()->mahasiswa_id;

        $jumlah_kehadiran = $request->input('jumlah_kehadiran_kelas');

        DB::table('ta2_mahasiswa_kelas')
            ->where('mahasiswa_id','=', $mahasiswa_id)
            ->orderBy('kelas_id', 'desc')
            ->limit(1)
            ->update(['jumlah_kehadiran_kelas' => $jumlah_kehadiran]);

        return back();
    }

    public function editTugasSubmit(Request $request) {
        $progress_summary = TA2_Progress_Summary::find($request->input('ps_id'));
        $data_summary = DB::table('ta2_progress_summary')
            ->join('ta2_ta', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->where('ta2_progress_summary.ps_id', '=', $progress_summary->ps_id)
            ->where('ta2_ta.status_lulus', '=', 0)->first();


        $mahasiswa_id = DB::table('ta2_ta')
            ->where('ta_id', '=', $data_summary->ta_id)
            ->first()->mahasiswa_id;

        DB::table('ta2_tugas_mahasiswa')
            ->where('ta2_tugas_mahasiswa.mahasiswa_id', '=', $mahasiswa_id)
            ->update(['sudah_dinilai' => 0]);

        $sudah_dinilai = $request['sudah_dinilai'];

        if(!empty($sudah_dinilai))
        {
            foreach ($sudah_dinilai as $tugas_mahasiswa_id) {
                DB::table('ta2_tugas_mahasiswa')
                    ->where('ta2_tugas_mahasiswa.mahasiswa_id', '=', $mahasiswa_id)
                    ->where('ta2_tugas_mahasiswa.tugas_id', '=', $tugas_mahasiswa_id)
                    ->update(['sudah_dinilai' => 1]);
            }
        }

        return back();
    }

    public function finalisasiTA(Request $request) {
        $request->validate([
           'ta_id' => 'required'
        ]);
        //rubah ta
        $ta_id = $request->input('ta_id');
        $ta2 = TA2_TA::find($ta_id);
        $ta2->status_lulus = 1;

        //rubah progress summary
        $ps = TA2_Progress_Summary::where([
           'ta_id' => $ta_id
        ])->first();
        $ps->status_lulus = 1;

        //save
        $ta2->save();
        $ps->save();

        //tutup semua topik ketika seluruh mahasiswa sudah lulus (TA1)
        $countUncheckout = DB::table('ta2_ta')
            ->where('ta2_ta.status_lulus', 0)
            ->count();
        if ($countUncheckout == 0) {
            DB::table('topik')
                ->update([
                    'status_buka' => false
                ]);
        }

        return redirect('/tu/ta2/administrasi/daftar_progress_summary');
    }


}

