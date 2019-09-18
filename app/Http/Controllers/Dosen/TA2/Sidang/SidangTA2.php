<?php

namespace App\Http\Controllers\Dosen\TA2\Sidang;

//use Carbon\Carbon;
//use Illuminate\Http\Request;
use App\Mahasiswa;
use App\TA2_Sidang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SidangTA2 extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $dosen_id = session('user_id');
        $dosen = DB::table('dosen')
            ->where('dosen.user_id', '=', $dosen_id)
            ->first();

        $listOfTA = DB::table('ta2_ta')
            ->join('ta2_dosen_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->where('ta2_dosen_ta.dosen_id', '=', $dosen_id)
            ->get();

        $listOfSidang = DB::table('ta2_sidang')
            ->where('ta2_sidang.status_pendaftaran', '<', '4')
            ->join('ta2_dosen_ta', 'ta2_sidang.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('ta2_ta', 'ta2_ta.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('mahasiswa', 'mahasiswa.user_id', '=', 'ta2_ta.mahasiswa_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->where('ta2_dosen_ta.dosen_id', '=', $dosen_id)
            ->select('mahasiswa.nama as nama', 'mahasiswa.nim as nim', 'ta2_sidang.ruangan as ruangan',
                'ta2_sidang.tanggal as tanggal', 'ta2_sidang.sidang_id as sidang_id',
                'ta2_ta.topik as topik', 'ta2_ta.judul as judul',
                'ta2_progress_summary.ps_id')
            ->get();

        $data['listOfSidang'] = $listOfSidang;
        $data['dosen'] = $dosen;
        $data['listOfTA'] = $listOfTA;
        return view('dosen.ta2.sidang.sidang', $data);
    }

    public function getPendingSidang()
    {
        //get all needed data with this query
        $list_sidang = DB::table('dosen')
            ->where('dosen.user_id', '=', session('user_id'))
            ->join('ta2_dosen_ta', 'dosen.user_id', '=', 'ta2_dosen_ta.dosen_id')
            ->join('ta2_ta', 'ta2_dosen_ta.ta_id', '=', 'ta2_ta.ta_id')
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->where('ta2_sidang.status_pendaftaran', '!=', '4')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=' , 'mahasiswa.user_id')
            ->select('mahasiswa.user_id as user_id' ,'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_ta.ta_id as ta_id', 'ta2_ta.topik as topik',
                'ta2_sidang.ruangan as ruangan','ta2_sidang.tanggal as tanggal',
                'ta2_sidang.sidang_id as sidang_id')
            ->get();
        /*
        foreach($list_sidang as $sidang) {
            echo $sidang->sidang_id . '<br>';
            echo $sidang->ta_id .'<br>';
            echo $sidang->nim . '<br>';
            echo $sidang->nama . '<br>';
            echo $sidang->ruangan . '<br>';
            echo $sidang->tanggal . '<br>';
            echo '<br>';
        }
        */
        $data['listOfSidang'] = $list_sidang;
        return view('dosen.ta2.sidang.list_sidang', $data);
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

        return view('dosen.ta2.sidang.edit_sidang', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }

    public function editSidangSubmit(Request $request) {
        $request->validate([
            'sidang_id' => 'required'
        ]);
//        echo $request->input('tanggal') . '<br>';
//        echo $request->input('ruangan') . '<br>';
//        echo $request->input('sidang_id') . '<br>';

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

        return redirect('/dosen/ta2/sidang/sidang');
    }
}
