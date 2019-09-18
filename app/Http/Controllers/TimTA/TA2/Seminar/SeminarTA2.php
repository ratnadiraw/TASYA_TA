<?php

namespace App\Http\Controllers\TimTA\TA2\Seminar;

use App\TA2_Progress_Summary;
use App\TA2_Seminar;
use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Mahasiswa;
use Carbon\Carbon;

class SeminarTA2 extends Controller
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
        $listOfSeminar = DB::table('ta2_seminar')
            ->where('ta2_seminar.status_pendaftaran', '!=', '3')
            ->where('ta2_seminar.status_pendaftaran', '!=', '4')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_seminar.ruangan as ruangan',
                'ta2_seminar.tanggal as tanggal', 'ta2_seminar.seminar_id as seminar_id',
                'ta2_progress_summary.ps_id as ps_id', 'ta2_ta.judul as judul')
            ->get();
        $data['listOfSeminar'] = $listOfSeminar;
        return view('tim_ta.ta2.seminar.seminar', $data);
    }

    public function editSeminarIndividual($seminar_id) {
        //data sidang
        $dataSeminar = DB::table('ta2_seminar')
            ->where('ta2_seminar.seminar_id','=',$seminar_id)
            ->join('ta2_ta', 'ta2_seminar.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_seminar.seminar_id as seminar_id', 'ta2_seminar.tanggal as tanggal',
                'ta2_seminar.ruangan as ruangan')
            ->first();

        return view('tim_ta.ta2.seminar.edit_seminar', [
            'data_seminar' => $dataSeminar,
        ]);
    }

    public function editSeminarIndividualSubmit(Request $request) {
        $request->validate([
            'seminar_id' => 'required'
        ]);

        $tanggal = $request->input('tanggal');
        $ruangan = $request->input('ruangan');
        $seminar_id = $request->input('seminar_id');

        $status_pendaftaran = 0;

        if ($tanggal != null) {
            $status_pendaftaran = 1;
            DB::table('ta2_seminar')
                ->where('seminar_id', $seminar_id)
                ->update([
                    'tanggal' => Carbon::parse($tanggal)
                ]);
        } else{
            DB::table('ta2_seminar')
                ->where('seminar_id', $seminar_id)
                ->update([
                    'tanggal' => null,
                ]);
        }

        if($ruangan != null) {
            $status_pendaftaran = 2;
            DB::table('ta2_seminar')
                ->where('seminar_id', $seminar_id)
                ->update([
                    'ruangan' => $ruangan,
                ]);
        } else {
            DB::table('ta2_seminar')
                ->where('seminar_id', $seminar_id)
                ->update([
                    'ruangan' => null,
                ]);
        }

        DB::table('ta2_seminar')
            ->where('seminar_id', $seminar_id)
            ->update([
                'status_pendaftaran' => $status_pendaftaran,
            ]);

        $ta2_id = TA2_Seminar::find($seminar_id)->ta_id;
        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $ta2_id,
        ])->first()->ps_id;

        return redirect('tim_ta/ta2/administrasi/edit_progress_summary/' . $ps_id);
    }

    public function editSeminarSubmit(Request $request)
    {
        $seminar_ids = $request->input('seminar_ids');
        $ruangans = $request->input('ruangans');
        $tanggals = $request->input('tanggals');

        for($i = 0; $i < count($seminar_ids); $i++) {
            $status_pendaftaran = 0;

            if ($tanggals[$i] != null) {
                $status_pendaftaran = 1;
                DB::table('ta2_seminar')
                    ->where('seminar_id', $seminar_ids[$i])
                    ->update([
                        'tanggal' => Carbon::parse($tanggals[$i])
                    ]);
            } else{
                DB::table('ta2_seminar')
                    ->where('seminar_id', $seminar_ids[$i])
                    ->update([
                        'tanggal' => null,
                    ]);
            }

            if($ruangans[$i] != null) {
                $status_pendaftaran = 2;
                DB::table('ta2_seminar')
                    ->where('seminar_id', $seminar_ids[$i])
                    ->update([
                        'ruangan' => $ruangans[$i],
                    ]);
            } else {
                DB::table('ta2_seminar')
                    ->where('seminar_id', $seminar_ids[$i])
                    ->update([
                        'ruangan' => null,
                    ]);
            }

            DB::table('ta2_seminar')
                ->where('seminar_id', $seminar_ids[$i])
                ->update([
                    'status_pendaftaran' => $status_pendaftaran,
                ]);

        }
        return back();
    }


    public function addSeminarSubmit(Request $request) {
        //validasi nim tidak boleh kosong
        $request->validate([
            'nim_mahasiswa' => 'required',
        ]);

        $nim = $request->input('nim_mahasiswa');

        $mahasiswa = Mahasiswa::where([
            'nim' => $nim,
        ])->first();

        //kalau mahasiswa tidak ada, return ke add_seminar
        if ($mahasiswa == null) {
            return back()->withErrors('error', 'mahasiswa null');
            }

        //cek apakah mahasiswa punya seminar yang belum selesais
        $seminars = TA2_Seminar::where('ta_id','=',$mahasiswa->current_ta2_id)
            ->where(function($query) {
                $query->where('status_pendaftaran','=',0)
                    ->orWhere('status_pendaftaran', '=', 1)
                    ->orWhere('status_pendaftaran', '=', 2);
            })->get();

        //kalau mahasiswa sudah didaftarkan maka tidak bisa lagi
        if (sizeof($seminars) != 0) {
            return back()->withErrors('error', 'mahasiswa sudah punya sidang');
        }

        //buat seminar baru
        $seminar = new TA2_Seminar;
        $seminar->ta_id = $mahasiswa->current_ta2_id;
        $seminar->status_pendaftaran = 0;
        $seminar->save();

        return back();
    }
}

