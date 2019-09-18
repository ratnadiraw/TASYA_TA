<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Mahasiswa;
use App\TA2_Bimbingan;
use App\TA2_Seminar;
use App\TA2_TA;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class SeminarTA2 extends Controller
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


  public function viewSeminar($seminar_id) {
     $seminar = TA2_Seminar::find($seminar_id);

     $mahasiswa = Mahasiswa::find(session('user_id'));
      if ($mahasiswa == null) {
          abort(403);
      }
     return view('mahasiswa.ta2.seminar', [
         'data_seminar' => $seminar,
         'data_mahasiswa' => $mahasiswa,
     ]);
  }


  public function getSeminar() {
      //mahasiswa
      $user_id = session('user_id');
      // echo $user_id . '<br>';
      $mahasiswa = Mahasiswa::findOrFail($user_id);

      //cari current ta2
      $ta2 = TA2_TA::find($mahasiswa->current_ta2_id);
      // echo $ta2->ta_id . '<br>';
      if ($ta2 == null) {
          return (403);
      }
      //cari semua seminar yang memenuhi
      $seminars = DB::table('ta2_seminar')
          ->where('ta_id', '=', $ta2->ta_id)
          ->where('status_pendaftaran', '!=', '3')
          ->select('ta2_seminar.seminar_id as seminar_id', 'ta2_seminar.ta_id as ta_id',
              'ta2_seminar.tanggal as tanggal', 'ta2_seminar.ruangan as ruangan',
              'ta2_seminar.status_pendaftaran as status_pendaftaran', 'ta2_seminar.nilai as nilai')
          ->first();

      return view('mahasiswa.ta2.seminar', [
              'data_mahasiswa' => $mahasiswa,
              'ta2' => $ta2,
              'data_seminar' => $seminars,
          ]);
  }    
}
