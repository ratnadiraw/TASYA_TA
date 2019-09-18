<?php

namespace App\Http\Controllers\TU;

use App\Dosen;
use App\DosenTemp;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranDosen extends Controller
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
        $listOfDosen = DB::table('dosen')
            ->join('users', 'users.id', '=' ,'dosen.user_id')
            ->paginate(10);
        return view('tu.pendaftaran.dosen',  [
            'listOfDosen' => $listOfDosen,
        ]);
    }

    public function addDosen(Request $request)
    {
        $request->validate([
            'NIP' => 'required',
            'name' => 'required',
            'inisial' => 'required',
            'wewenang-pembimbing' =>'required',
//            'kk' => 'required',
            'email' => 'required|email',
        ]);
        $nip = $request->input('NIP');
        $name = $request->input('name');
//        $kelompok_keahlian = $request->input('kk');

        $wewenang = $request->input('wewenang-pembimbing');
        $inisial = $request->input('inisial');
        $email = $request->input('email');
        $password = bcrypt('DOSEN_'.$nip);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $last_id = $user->id;
        $dosen = new DosenTemp;
        $dosen->user_id = $last_id;
        $dosen->nip = $nip;
        $dosen->nama = $name;
        $dosen->inisial = $inisial;
        $dosen->wewenang_pembimbing = $wewenang;
//        $dosen->kelompok_keahlian = $kelompok_keahlian;
        $dosen->save();

        return back();
    }

     public function show($id) {
        $dosen = DosenTemp::where('user_id','=',$id)->first();
        $dosen['email'] = User::find($dosen->user_id)->email;
        $data['dosen'] = $dosen;

        return view('tu.pendaftaran.dosen_update', $data);
    }

    public function delete($id) {
        $user = User::find($id);
        $dosen = DosenTemp::find($id);


        $dosen->delete();
        $user->delete();

        return back();
    }

    public function update($id, Request $request) {
        $dosen = DosenTemp::where('user_id','=',$id)->first();
        $user = User::find($dosen->user_id);
        //cek email dllnya kalau bukan dia
        $request->validate([
            'NIP' => 'required',
            'name' => 'required',
            'inisial' => 'required',
            'wewenang-pembimbing' =>'required',
//            'kk' => 'required',
            'email' => 'required|email',
        ]);
        $dosen->nip = $request->input('NIP');
        $dosen->nama = $request->input('name');
//        $dosen->kelompok_keahlian = $request->input('kk');
        $dosen->wewenang_pembimbing = $request->input('wewenang-pembimbing');
        $dosen->inisial = $request->input('inisial');

        $dosen->save();

        $user->email = $request->input('email');

        $user->save();

        return redirect('/tu/pendaftaran/user');
    }
}
