<?php

namespace App\Http\Controllers\TimTA\TA1\Seminar;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
    public function index()
    {
        $listOfSeminar = DB::table('ta1_seminar')
            ->join('ta1_tugas_akhir', 'ta1_tugas_akhir.id', '=', 'ta1_seminar.ta_id')
            ->where('ta1_tugas_akhir.status_checkout', 0)
            ->join('ta1_dosen_ta', 'ta1_dosen_ta.ta_id', '=', 'ta1_tugas_akhir.id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta1_tugas_akhir.mahasiswa_id')
            ->join('topik', 'topik.topik_id', '=', 'ta1_tugas_akhir.topik_id')
            ->where('ta1_seminar.final', 1)
            ->select('ta1_seminar.id as seminar_id', 'ta1_tugas_akhir.nama_topik', 'ta1_seminar.kloter as kloter',
                'ta1_seminar.ruangan', 'ta1_seminar.waktu', 'ta1_tugas_akhir.id as ta_id', 'mahasiswa.nim as nim',
                'mahasiswa.nama as nama_mahasiswa', 'topik.laboratorium_keahlian', 'ta1_seminar.shift')
            ->distinct()
            ->get();

        foreach($listOfSeminar as $seminar) {
            $data['listOfPembimbing'.$seminar->seminar_id] = DB::table('ta1_dosen_ta')
                ->where('ta_id', $seminar->ta_id)
                ->join('dosen', 'dosen.user_id', '=', 'ta1_dosen_ta.dosen_id')
                ->select('dosen.user_id', 'dosen.nama')
                ->distinct()
                ->get();

            $data['listOfPenguji'.$seminar->seminar_id] = DB::table('ta1_surat_seminar')
                ->where('seminar_id', $seminar->seminar_id)
                ->leftJoin('dosen as dosen1', 'dosen1.user_id', '=', 'ta1_surat_seminar.penguji1_id')
                ->leftJoin('dosen as dosen2', 'dosen2.user_id', '=', 'ta1_surat_seminar.penguji2_id')
                ->select('dosen1.user_id as penguji1_id', 'dosen2.user_id as penguji2_id', 'dosen1.nama as penguji1_nama',
                    'dosen2.nama as penguji2_nama')
                ->distinct()
                ->get();
        }

        $data['listOfPenguji'] = DB::table('ta1_surat_seminar')
            ->join('dosen as dosen1', 'dosen1.user_id', '=', 'ta1_surat_seminar.penguji1_id')
            ->leftJoin('dosen as dosen2', 'dosen2.user_id', '=', 'ta1_surat_seminar.penguji2_id')
            ->select('dosen1.user_id as penguji1_id', 'dosen2.user_id as penguji2_id', 'dosen1.nama as penguji1_nama',
                'dosen2.nama as penguji2_nama')
            ->distinct()
            ->get();
        $data['listOfDosen'] = DB::table('dosen')
            ->get();

        $data['listOfSeminar'] = $listOfSeminar;
        return view('tim_ta.ta1.seminar.seminar', $data);
    }

    public function editSeminar(Request $request)
    {
        $seminarIds = $request->input('seminar-id');
        $rooms = $request->input('room');
        $datetimes = $request->input('datetime');
        $kloters = $request->input('kloter');
        $shifts = $request->input('shift');

        $pembimbings1 = $request->input('pembimbing-1');
        $pembimbings2 = $request->input('pembimbing-2');
        $pengujis1 = $request->input('penguji-1');

        $request->validate([
            'datetime.*' => 'nullable|date',
            'shift.*' => 'nullable|integer'
        ]);

        if (isset($seminarIds) && count($seminarIds) > 0) {
            $counter = 0;
            foreach ($seminarIds as $seminarId) {

                DB::table('ta1_seminar')
                    ->where('id', $seminarId)
                    ->update([
                        'ruangan' => $rooms[$counter],
                        'waktu' => Carbon::parse($datetimes[$counter]),
                        'kloter' => $kloters[$counter],
                        'shift' => $shifts[$counter]
                    ]);

                $check = count(DB::table('ta1_surat_seminar')
                    ->where('seminar_id', $seminarId)
                    ->get()) == 0;

                if ($check) {
                    DB::table('ta1_surat_seminar')
                        ->insert([
                            'pembimbing_id' => $pembimbings1[$counter],
                            'pembimbing_opsional_id' => $pembimbings2[$counter],
                            'penguji1_id' => $pengujis1[$counter],
                            'seminar_id' => $seminarId
                        ]);
                } else {
                    DB::table('ta1_surat_seminar')
                        ->where('seminar_id', $seminarId)
                        ->update([
                            'pembimbing_id' => $pembimbings1[$counter],
                            'pembimbing_opsional_id' => $pembimbings2[$counter],
                            'penguji1_id' => $pengujis1[$counter]
                        ]);
                }

                $counter++;
            }
        }
        return redirect('/tim_ta/ta1/seminar/jadwal_seminar');
    }
}
