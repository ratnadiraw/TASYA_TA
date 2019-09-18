<?php

namespace App\Http\Controllers\TimTA\TA2\Administrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Bimbingan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($ta_id)
    {
        $all_bimbingan = DB::table('ta2_ta')
			->where('ta2_ta.ta_id', '=', $ta_id)
            ->join('ta2_bimbingan', 'ta2_bimbingan.ta_id', '=', 'ta2_ta.ta_id')
			->where('ta2_bimbingan.approved', '=', 1)
            ->join('mahasiswa', 'ta2_ta.mahasiswa_id', '=', 'mahasiswa.user_id')
            ->get();

        return view('tim_ta.ta2.administrasi.show_bimbingan',[
            'all_bimbingan' => $all_bimbingan
        ]);
    }

    public function review($bimbingan_id)
    {
        $bimbingan = DB::table('ta2_bimbingan')
            ->where('ta2_bimbingan.bimbingan_id', '=', $bimbingan_id)
            ->first();

        return view('tim_ta.ta2.administrasi.review_bimbingan', [
            'bimbingan' => $bimbingan
        ]);
    }
}