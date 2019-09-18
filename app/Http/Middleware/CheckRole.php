<?php

namespace App\Http\Middleware;

use App\DosenTemp;
use Closure;
use App\Mahasiswa;
use App\TU;
use App\Dosen;
use App\TimTA;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            switch ($role) {
                case 'dosen':
                    if (DosenTemp::where('user_id', Auth::id())->first() == null) {
                        return back();
                    }
                    break;

                case 'mahasiswa':
                    if (Mahasiswa::find(Auth::id()) == null) {
                        return back();
                    }
                    break;

                case 'tu':
                    if (TU::find(Auth::id()) == null) {
                        return back();
                    }
                    break;

                case 'tim_ta':
                    if (TimTA::where('user_id',Auth::id())->first() == null) {
                        return back();
                    }
                    break;

                default:
                    
                    break;
            }
        } 

        return $next($request);
    }
}
