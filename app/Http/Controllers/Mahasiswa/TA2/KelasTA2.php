<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class KelasTA2 extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $mahasiswa_id = session('user_id');

        $mahasiswa = DB::table('mahasiswa')
            ->where('mahasiswa.user_id', '=', $mahasiswa_id)
            ->first();

        $all_tugas = DB::table('ta2_tugas_mahasiswa')
            ->where('ta2_tugas_mahasiswa.mahasiswa_id','=',$mahasiswa_id)
            ->join('ta2_tugas', 'ta2_tugas_mahasiswa.tugas_id', '=', 'ta2_tugas.tugas_id')
            ->get();

        return view('mahasiswa.ta2.kelas', [
            'mahasiswa' => $mahasiswa,
            'all_tugas' => $all_tugas,
        ]);

    }
}
