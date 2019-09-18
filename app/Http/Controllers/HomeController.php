<?php

namespace App\Http\Controllers;

use App\DosenTemp;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Dosen;
use App\TU;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Calendar;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_id = Auth::id();
        session(['user_id' => $user_id]);

        if (Auth::user()) {
            if (Auth::user()->isMahasiswa()) {
                $nim = Mahasiswa::find($user_id)->nim;
                session(['nomor_induk' => $nim]);
                return redirect('/mahasiswa/home');
            } else if (Auth::user()->isDosen()) {
                $nip = DosenTemp::where('user_id', Auth::id())->first()->nip;
                session(['nomor_induk' => $nip]);
                return redirect('/dosen/home');
            } else if (Auth::user()->isTU()) {
                $nip = TU::find($user_id)->nip;
                session(['nomor_induk' => $nip]);
                return redirect('/tu/home');
            } else if (Auth::user()->isTimTA()) {
                return redirect('/tim_ta/home');
            }
        } else {
            return redirect('/login');
        }
    }

    public function homeTU() {
        $dateNow = Carbon::now()->toDateString();
        $tahunSemester = DB::table('tahun_ajaran')
            ->where('tanggal_mulai', '<=', $dateNow)
            ->where('tanggal_selesai', '>=', $dateNow)
            ->latest()->first();
        session(['tahun_semester' => $tahunSemester]);
        return view('tu.home');
    }

    public function homeTimTA() {
        $dateNow = Carbon::now()->toDateString();
        $tahunSemester = DB::table('tahun_ajaran')
            ->where('tanggal_mulai', '<=', $dateNow)
            ->where('tanggal_selesai', '>=', $dateNow)
            ->latest()->first();
        session(['tahun_semester' => $tahunSemester]);
        return view('tim_ta.home');
    }

    public function homeMahasiswa() {
        $dateNow = Carbon::now()->toDateString();
        $tahunSemester = DB::table('tahun_ajaran')
            ->where('tanggal_mulai', '<=', $dateNow)
            ->where('tanggal_selesai', '>=', $dateNow)
            ->latest()->first();
        session(['tahun_semester' => $tahunSemester]);
        return view('mahasiswa.home');
    }

    public function homeDosen() {
        $dateNow = Carbon::now()->toDateString();
        $tahunSemester = DB::table('tahun_ajaran')
            ->where('tanggal_mulai', '<=', $dateNow)
            ->where('tanggal_selesai', '>=', $dateNow)
            ->latest()->first();
        session(['tahun_semester' => $tahunSemester]);

        $message = "";
        if (Auth::user()->isTimTA()) {
            $message = "timta";
        }
        return view('dosen.home', [
            'message' => $message
        ]);
    }
}
