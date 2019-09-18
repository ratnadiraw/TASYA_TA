<?php

namespace App\Http\Controllers\TU\TA2\Sidang;

use App\Mahasiswa;
use App\TA2_Progress_Summary;
use App\TA2_Sidang;
use App\TA2_TA;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SidangTA2 extends Controller
{
    public function index()
    {
        $listOfSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran' , '<', '4')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_ta.status_lulus', '=', '0')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_progress_summary.ta_id', '=', 'ta2_ta.ta_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id',
                'ta2_ta.topik as topik', 'ta2_ta.judul as judul', 'ta2_progress_summary.ps_id as ps_id')
            ->get();
        $data['listOfSidang'] = $listOfSidang;
        return view('tu.ta2.sidang.sidang', $data);
    }

    public function addSidangSubmit(Request $request) {
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
        $sidangs = TA2_Sidang::where('ta_id','=',$mahasiswa->current_ta2_id)
            ->where(function($query) {
                $query->where('status_pendaftaran','=',0)
                    ->orWhere('status_pendaftaran', '=', 1)
                    ->orWhere('status_pendaftaran', '=', 2)
                    ->orWhere('status_pendaftaran', '=', 3);
            })->get();

        //kalau mahasiswa sudah didaftarkan maka tidak bisa lagi
        if (count($sidangs) > 0) {
            return back()->withErrors('error', 'mahasiswa sudah punya sidang');
        }

        //buat seminar baru
        $sidang = new TA2_Sidang;
        $sidang->ta_id = $mahasiswa->current_ta2_id;
        $sidang->judul = TA2_TA::find($mahasiswa->current_ta2_id)->judul;
        $sidang->status_pendaftaran = 0;
        $sidang->save();

        return back();
    }

    public function editSidang($sidang_id) {
        //data sidang
        $dataSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id','=',$sidang_id)
            ->join('ta2_ta', 'ta2_sidang.ta_id', '=', 'ta2_ta.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_sidang.sidang_id as sidang_id', 'ta2_sidang.tanggal as tanggal',
                'ta2_sidang.ruangan as ruangan')
            ->first();

        //data dosen penguji
        $dosenPenguji = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_dosen_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_dosen_sidang.sidang_id')
            ->join('dosen', 'ta2_dosen_sidang.dosen_id', '=', 'dosen.user_id')
            ->select('dosen.nama as nama', 'dosen.user_id as dosen_id')
            ->get();

        return view('tu.ta2.sidang.edit_sidang', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }

    public function editSidangSubmit(Request $request) {
        $request->validate([
           'sidang_id' => 'required'
        ]);

        $tanggal = $request->input('tanggal');
        $ruangan = $request->input('ruangan');
        $sidang_id = $request->input('sidang_id');

        $status_pendaftaran = 1;

        if ($tanggal != null) {
            $status_pendaftaran = 2;
            DB::table('ta2_sidang')
                ->where('sidang_id', $sidang_id)
                ->update([
                    'tanggal' => Carbon::parse($tanggal)
                ]);
        } else{
            DB::table('ta2_sidang')
                ->where('sidang_id', $sidang_id)
                ->update([
                    'tanggal' => null,
                ]);
        }

        if($ruangan != null) {
            $status_pendaftaran = 3;
            DB::table('ta2_sidang')
                ->where('sidang_id', $sidang_id)
                ->update([
                    'ruangan' => $ruangan,
                ]);
        } else {
            DB::table('ta2_sidang')
                ->where('sidang_id', $sidang_id)
                ->update([
                    'ruangan' => null,
                ]);
        }

        DB::table('ta2_sidang')
            ->where('sidang_id', $sidang_id)
            ->update([
                'status_pendaftaran' => $status_pendaftaran,
            ]);

        //ps_id
        $sidang = TA2_Sidang::find($sidang_id);
        $ps_id = TA2_Progress_Summary::where([
            'ta_id' => $sidang->ta_id,
        ])->first()->ps_id;

        return redirect('/tu/ta2/administrasi/edit_progress_summary/' . $ps_id);
    }
}
