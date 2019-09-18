<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
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
        $userId = Auth::user()->id;

        $user = DB::table('users')
            ->where('id', $userId)
            ->first();
        $data['user'] = $user;
        return view('layouts.edit_profile', $data);
    }

    public function saveProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $newName = $request->input('name');
        $newEmail = $request->input('email');
        $currentPassword = $request->input('current-password');
        $newPassword = $request->input('new-password');
        $newRepeatPassword = $request->input('repeat-password');
        error_log(bcrypt($currentPassword));
        if ($newPassword != $newRepeatPassword) {
            return back();
        } else {
            if (isset($newName) || isset($newEmail) || isset($newPassword)) {
//                if (isset($newName)) {
//                    DB::table('users')
//                        ->where('id', $userId)
//                        ->update([
//                            'name' => $newName
//                        ]);
//                }
                if (isset($newPassword)) {
                    if (isset($currentPassword) && Hash::check($currentPassword, Auth::user()->getAuthPassword())) {
                        DB::table('users')
                            ->where('id', $userId)
                            ->update([
                                'password' => Hash::make($newPassword)
                            ]);
                        return redirect('/');
                    } else {
                        return back();
                    }
                }
                if (isset($newEmail)) {
                    $checkEmail = DB::table('users')
                        ->where('id', '!=', $userId)
                        ->where('email', $newEmail)
                        ->get();
                    if (count($checkEmail) > 0) {
                        return back();
                    } else {
                        DB::table('users')
                            ->where('id', $userId)
                            ->update([
                                'email' => $newEmail
                            ]);
                    }
                }
                return redirect('/');
            } else {
                return back();
            }
        }
    }
}
