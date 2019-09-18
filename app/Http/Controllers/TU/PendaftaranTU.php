<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\TU;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranTU extends Controller
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
    public function index()
    {
        $listOfTU = DB::table('tu')
            ->join('users', 'users.id', '=' ,'tu.user_id')
            ->paginate(10);
        return view('tu.pendaftaran.tu',  [
            'listOfTU' => $listOfTU,
        ]);
    }

    public function addTU(Request $request)
    {
        $request->validate([
            'NIP' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $nip = $request->input('NIP');
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('TU_'.$nip);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $last_id = $user->id;
        $tu = new TU;
        $tu->user_id = $last_id;
        $tu->nip = $nip;
        $tu->nama = $name;
        $tu->save();

        return back();
    }
}
