<?php

namespace App\Http\Controllers\Dosen\TA2\Seminar;

use App\TA2_Progress_Summary;
use App\TA2_Seminar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SeminarTA2 extends Controller
{
    
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getfinishedSeminars($mahasiswa_id) {
      //get all needed data with this query
      $list_seminar = DB::table('dosen')
          ->where('dosen.user_id', '=', session('user_id'))
          ->join('ta2_dosen_ta', 'dosen.user_id', '=', 'ta2_dosen_ta.dosen_id')
          ->join('ta2_ta', 'ta2_dosen_ta.ta_id', '=', 'ta2_ta.ta_id')
          ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
          ->where('ta2_seminar.status_pendaftaran', '=', '3')
          ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=' , 'mahasiswa.user_id')
          ->select('mahasiswa.user_id as user_id' ,'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
              'ta2_ta.ta_id as ta_id',
              'ta2_seminar.ruangan as ruangan','ta2_seminar.tanggal as tanggal',
              'ta2_seminar.seminar_id as seminar_id', 'ta2_ta.judul as judul')
          ->get();

      foreach($list_seminar as $seminar) {
          echo $seminar['nim'] . '<br>';
          echo $seminar['nama'] . '<br>';
          echo $seminar['ruangan'] . '<br>';
          echo $seminar['tanggal'] . '<br>';
          echo '<br>';
      }


    }

    public function getPendingSeminars() {
        //get all needed data with this query
        $list_seminar = DB::table('dosen')
            ->where('dosen.user_id', '=', session('user_id'))
            ->join('ta2_dosen_ta', 'dosen.user_id', '=', 'ta2_dosen_ta.dosen_id')
            ->join('ta2_ta', 'ta2_dosen_ta.ta_id', '=', 'ta2_ta.ta_id')
            ->join('ta2_seminar', 'ta2_ta.ta_id', '=', 'ta2_seminar.ta_id')
            ->where('ta2_seminar.status_pendaftaran', '!=', '3')
            ->where('ta2_seminar.status_pendaftaran', '!=', '4')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=' , 'mahasiswa.user_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.user_id as user_id' ,'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_ta.ta_id as ta_id',
                'ta2_seminar.ruangan as ruangan','ta2_seminar.tanggal as tanggal',
                'ta2_seminar.seminar_id as seminar_id', 'ta2_ta.judul as judul',
                'ta2_progress_summary.ps_id as ps_id')
            ->get();

        $data['listOfSeminar'] = $list_seminar;
        return view('dosen.ta2.seminar.list_seminar', $data);
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

        return view('dosen.ta2.seminar.edit_seminar_individual  ', [
            'data_seminar' => $dataSeminar,
        ]);
    }

    public function editSeminarIndividualSubmit(Request $request) {
        $request->validate([
            'seminar_id' => 'required'
        ]);

        $tanggal = $request->input('tanggal');
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


        DB::table('ta2_seminar')
            ->where('seminar_id', $seminar_id)
            ->update([
                'status_pendaftaran' => $status_pendaftaran,
            ]);

        $ta2_id = TA2_Seminar::find($seminar_id)->ta_id;
        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $ta2_id,
        ])->first()->ps_id;

        return redirect('dosen/ta2/progress_summary/view_progress_summary/' . $ps_id);
    }

    public function editSeminarSubmit(Request $request) {
        $seminar_ids = $request->input('seminar_ids');
        $tanggals = $request->input('tanggals');

        for($i = 0; $i < count($seminar_ids); $i++) {
            $status_pendaftaran = 0;

            if ($tanggals[$i] != null) {
                $status_pendaftaran = 1;

                DB::table('ta2_seminar')
                    ->where('seminar_id', '=', $seminar_ids[$i])
                    ->update([
                        'tanggal' => Carbon::parse($tanggals[$i])
                    ]);

            } else {
                DB::table('ta2_seminar')
                    ->where('seminar_id', '=', $seminar_ids[$i])
                    ->update([
                       'tanggal' => null,
                    ]);
            }


            DB::table('ta2_seminar')
                ->where('seminar_id', '=', $seminar_ids[$i])
                ->update([
                   'status_pendaftaran' => $status_pendaftaran
                ]);


        }
        return back();
    }
}




