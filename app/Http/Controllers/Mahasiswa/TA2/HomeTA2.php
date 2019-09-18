<?php

namespace App\Http\Controllers\Mahasiswa\TA2;

use App\TA2_TA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeTA2 extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $mahasiswa_id = session('user_id');

        $ta = TA2_TA::where('mahasiswa_id', $mahasiswa_id)
            ->first();
        if ($ta == null) {
            abort('403');
        }

        return view('mahasiswa.ta2.home');
    }
}
