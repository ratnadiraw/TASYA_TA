<?php

namespace App\Http\Controllers\Dosen\TA2\Sidang;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SidangPengujiTA2 extends Controller
{
    public function index() {
        $listOfSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran' , '<', '4')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_ta.status_lulus', '=', '0')
            ->join('ta2_dosen_sidang', 'ta2_sidang.sidang_id', '=', 'ta2_dosen_sidang.sidang_id')
            ->where('ta2_dosen_sidang.dosen_id', '=', session('user_id'))
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id',
                'ta2_ta.topik as topik', 'ta2_ta.judul as judul')
            ->get();

        $data['listOfSidang'] = $listOfSidang;

        return view('dosen.ta2.sidang.sidang_penguji', $data);
    }

    public function view($sidang_id) {
        $dataSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id','=',$sidang_id)
            ->join('ta2_ta', 'ta2_sidang.ta_id', '=', 'ta2_ta.ta_id')
            ->where('ta2_ta.status_lulus', '=', '0')
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

        return view('dosen.ta2.sidang.view_sidang_penguji', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }

    public function submit(Request $request) {
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

        return redirect('/dosen/ta2/sidang/sidang_penguji');
    }
}
