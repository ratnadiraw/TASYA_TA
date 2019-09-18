<?php

namespace App\Http\Controllers\TimTA\TA2\Sidang;

use App\Http\Controllers\Controller;
use App\TA2_Progress_Summary;
use App\TA2_Sidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Sidang extends Controller
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
        //get all needed data with this query
        $list_sidang = DB::table('ta2_ta')
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=' , 'mahasiswa.user_id')
            ->select('mahasiswa.user_id as user_id' ,'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_ta.ta_id as ta_id', 'ta2_ta.topik as topik',
                'ta2_sidang.ruangan as ruangan','ta2_sidang.tanggal as tanggal',
                'ta2_sidang.sidang_id as sidang_id')
            ->where('ta2_sidang.status_pendaftaran', '<', '4')
            ->get();
        $data['listOfSidang'] = $list_sidang;
        return view('tim_ta.ta2.sidang.sidang', $data);
    }

    public function listSidang()
    {
        //get all needed data with this query
        $list_sidang = DB::table('ta2_ta')
            ->join('ta2_sidang', 'ta2_ta.ta_id', '=', 'ta2_sidang.ta_id')
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=' , 'mahasiswa.user_id')
            ->join('ta2_progress_summary', 'ta2_ta.ta_id', '=', 'ta2_progress_summary.ta_id')
            ->select('mahasiswa.user_id as user_id' ,'mahasiswa.nama as nama', 'mahasiswa.nim as nim',
                'ta2_ta.ta_id as ta_id', 'ta2_ta.topik as topik',
                'ta2_sidang.ruangan as ruangan','ta2_sidang.tanggal as tanggal',
                'ta2_sidang.sidang_id as sidang_id',
                'ta2_progress_summary.ps_id as ps_id')
            ->where('ta2_sidang.status_pendaftaran', '<', '4')
            ->get();
        $data['listOfSidang'] = $list_sidang;
        return view('tim_ta.ta2.sidang.list_sidang', $data);
    }

    public function editSidangIndividual($sidang_id) {
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
        $dosenPembimbing = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_dosen_ta','ta2_sidang.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('dosen', 'ta2_dosen_ta.dosen_id', '=', 'dosen.user_id')
            ->select('dosen.nama as nama')
            ->get();

        if (count($dosenPembimbing) > 0) {
            $dosbing1 = $dosenPembimbing[0]->nama;
        }
        if(count($dosenPembimbing) > 1) {
            $dosbing2 = $dosenPembimbing[1]->nama;
        }

        $allDosen = DB::table('dosen')
            ->select('dosen.nama as nama', 'dosen.nip as nip')
            ->get();

        $dosenPenguji = [];

        foreach($allDosen as $dosen)
        {
            if(count($dosenPembimbing) > 0) {
                if ($dosen->nama != $dosbing1) {
                    if (count($dosenPembimbing) > 1) {
                        if ($dosen->nama == $dosbing2) continue;
                    }

                    array_push($dosenPenguji, [
                        'nip' => $dosen->nip,
                        'nama' => $dosen->nama
                    ]);
                }
            } else {
                array_push($dosenPenguji, [
                    'nip' => $dosen->nip,
                    'nama' => $dosen->nama
                ]);
            }
        }

        return view('tim_ta.ta2.sidang.edit_sidang_individual', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }

    public function editSidangIndividualSubmit(Request $request)
    {
        if($request['dosen1'] == $request['dosen2']) return back()->with('error','Dosen penguji harus berbeda.');
        else
        {
            $dosen_id_1 = DB::table('dosen')->where('dosen.nip', '=', $request['dosen1'])->select('dosen.user_id as id')->first()->id;
            $dosen_id_2 = DB::table('dosen')->where('dosen.nip', '=', $request['dosen2'])->select('dosen.user_id as id')->first()->id;

            //check apakah sudah ada di dosen ta
            $ada = DB::table('ta2_dosen_sidang')
                ->where('dosen_id', '=', $dosen_id_1)
                ->where('sidang_id', '=', $request->input('sidang_id'))
                ->first();

            if ($ada == false) {
                DB::table('ta2_dosen_sidang')
                    ->insert([
                        'dosen_id' => $dosen_id_1,
                        'sidang_id' => $request['sidang_id'],
                        'created_at' => Carbon::now()
                    ]);
            }

            $ada = DB::table('ta2_dosen_sidang')
                ->where('dosen_id', '=', $dosen_id_2)
                ->where('sidang_id', '=', $request->input('sidang_id'))
                ->first();
            if ($ada == false) {
                DB::table('ta2_dosen_sidang')
                    ->insert([
                        'dosen_id' => $dosen_id_2,
                        'sidang_id' => $request['sidang_id'],
                        'created_at' => Carbon::now()
                    ]);
            }

            $ta2_id = TA2_Sidang::find($request->input('sidang_id'))->ta_id;
            $ps_id = TA2_Progress_Summary::where([
                'ta_id' => $ta2_id,
            ])->first()->ps_id;
            echo $request->input('sidang_id');
            return redirect('/tim_ta/ta2/administrasi/edit_progress_summary/' . $ps_id);
        }
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
        $dosenPembimbing = DB::table('ta2_sidang')
            ->where('ta2_sidang.sidang_id', '=', $sidang_id)
            ->join('ta2_dosen_ta','ta2_sidang.ta_id', '=', 'ta2_dosen_ta.ta_id')
            ->join('dosen', 'ta2_dosen_ta.dosen_id', '=', 'dosen.user_id')
            ->select('dosen.nama as nama')
            ->get();

        $dosbing1 = $dosenPembimbing[0]->nama;
        if(count($dosenPembimbing) > 1) $dosbing2 = $dosenPembimbing[1]->nama;

        $allDosen = DB::table('dosen')
            ->select('dosen.nama as nama', 'dosen.nip as nip')
            ->get();

        $dosenPenguji = [];

        foreach($allDosen as $dosen)
        {
            if($dosen->nama != $dosbing1)
            {
                if(count($dosenPembimbing) > 1)
                {
                    if($dosen->nama == $dosbing2) continue;
                }

                array_push($dosenPenguji, [
                    'nip' => $dosen->nip,
                    'nama' => $dosen->nama
                ]);
            }
        }

        return view('tim_ta.ta2.sidang.edit_sidang', [
            'data_sidang' => $dataSidang,
            'dosen_penguji' => $dosenPenguji,
        ]);
    }

    public function edit_sidang_submit(Request $request)
    {
        if($request['dosen1'] == $request['dosen2']) return back()->with('error','Dosen penguji harus berbeda.');
        else
        {
            $dosen_id_1 = DB::table('dosen')->where('dosen.nip', '=', $request['dosen1'])->select('dosen.user_id as id')->first()->id;
            $dosen_id_2 = DB::table('dosen')->where('dosen.nip', '=', $request['dosen2'])->select('dosen.user_id as id')->first()->id;

            //check apakah sudah ada di dosen ta
            $ada = DB::table('ta2_dosen_sidang')
                ->where('dosen_id', '=', $dosen_id_1)
                ->first();
            if ($ada == false) {
                DB::table('ta2_dosen_sidang')
                    ->insert([
                        'dosen_id' => $dosen_id_1,
                        'sidang_id' => $request['sidang_id'],
                        'created_at' => Carbon::now()
                    ]);
            }

            $ada = DB::table('ta2_dosen_sidang')
                ->where('dosen_id', '=', $dosen_id_2)
                ->first();
            if ($ada == false) {
                DB::table('ta2_dosen_sidang')
                    ->insert([
                        'dosen_id' => $dosen_id_2,
                        'sidang_id' => $request['sidang_id'],
                        'created_at' => Carbon::now()
                    ]);
            }

            return redirect('/tim_ta/ta2/sidang/list_sidang');
        }
    }
}