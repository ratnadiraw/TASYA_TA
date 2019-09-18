<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\TimTA;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranTimTA extends Controller
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
        $listOfTimTA = DB::table('tim_ta')
            ->join('users', 'users.id', '=' ,'tim_ta.user_id')
            ->paginate(10);
        return view('tu.pendaftaran.timta',  [
            'listOfTimTA' => $listOfTimTA,
        ]);
    }

    public function addTimTA(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('TimTA_'.$email);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        $last_id = $user->id;
        $timta = new TimTA;
        $timta->user_id = $last_id;
        $timta->save();

        return back();
    }

    public function tambah($id)
    {

        $user = User::find($id);


        $last_id = $user->id;
        $timta = new TimTA;
        $timta->user_id = $last_id;
        $timta->save();

        return back();
    }

    public function hapus($id) {
//        $user = User::find($id);

        TimTA::where('user_id', $id)->delete();
//        $user->delete();

        return back();
    }

    public function delete($id) {
        $user = User::find($id);

        TimTA::where('user_id', $id)->delete();
        $user->delete();

        return back();
    }

    public function show($id) {
        $timta = TimTA::where('user_id', $id)->first();
        $timta['email'] = User::find($timta->user_id)->email;
        $timta['nama'] = User::find($timta->user_id)->name;
        $data['timta'] = $timta;

        return view('tu.pendaftaran.timta_update', $data);
    }

    public function update($id, Request $request) {
        $timta = TimTA::where('user_id', $id)->first();
        $user = User::find($timta->user_id);

        
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect('/tu/pendaftaran/user');
    }
}
