<?php

namespace App\Http\Controllers\Dosen\TA1\Seminar;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function schedulePenguji()
    {
        $dosenId = Auth::user()->id;
        $listOfMahasiswa1 = DB::table('ta1_surat_seminar')
            ->where('penguji1_id', $dosenId)
            ->join('ta1_seminar', 'ta1_surat_seminar.seminar_id', '=', 'ta1_seminar.id')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->get();

        $listOfMahasiswa2 = DB::table('ta1_surat_seminar')
            ->where('penguji2_id', $dosenId)
            ->join('ta1_seminar', 'ta1_surat_seminar.seminar_id', '=', 'ta1_seminar.id')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->get();

        $data['listOfMahasiswa1'] = $listOfMahasiswa1;
        $data['listOfMahasiswa2'] = $listOfMahasiswa2;
        return view('dosen.ta1.seminar.seminar_penguji', $data);
    }

    public function schedulePembimbing()
    {
        $dosenId = Auth::user()->id;
        $listOfMahasiswa1 = DB::table('ta1_surat_seminar')
            ->where('pembimbing_id', $dosenId)
            ->join('ta1_seminar', 'ta1_surat_seminar.seminar_id', '=', 'ta1_seminar.id')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->get();

        $listOfMahasiswa2 = DB::table('ta1_surat_seminar')
            ->where('pembimbing_opsional_id', $dosenId)
            ->join('ta1_seminar', 'ta1_surat_seminar.seminar_id', '=', 'ta1_seminar.id')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->get();

        $data['listOfMahasiswa1'] = $listOfMahasiswa1;
        $data['listOfMahasiswa2'] = $listOfMahasiswa2;
        return view('dosen.ta1.seminar.seminar_pembimbing', $data);
    }

    public function editSeminarSchedule(Request $request)
    {
        $request->validate([
            'datetime.*' => 'nullable|date'
        ]);
        $seminarIds = $request->input('seminar-id');
        $datetimes = $request->input('datetime');

        $counter = 0;
        foreach ($seminarIds as $seminarId) {
            if ($datetimes[$counter] != null) {
                DB::table('ta1_seminar')
                    ->where('id', $seminarId)
                    ->update([
                        'waktu' => Carbon::parse($datetimes[$counter])
                    ]);
            }
            $counter++;
        }
        return back();
    }
}
