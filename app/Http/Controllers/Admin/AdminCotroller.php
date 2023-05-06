<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminCotroller extends Controller
{
    public function check(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $cred = $request->only('username', 'password');
        if(Auth::guard('admin')->attempt($cred)){
            return redirect('/admin-home');
        }
        return redirect()->back()->with('alert-danger', 'Invalid credentials');
    }

    public function index(User $user){
        $users = $user::all();

        return view('admin.home', compact('users'));
    }

    public function block(Request $request, User $user){
        $get = $user::where('id', $request->id)->first();

        if($get->allow){
            $get->allow = 0;
            $get->save();

            return redirect()->back();
        }else{
            $get->allow = 1;
            $get->save();

            return redirect()->back();
        }

    }

    public function user(Request $request, User $user){

        $profile = $user::where('id', $request->id)->first();

        return view('admin.user-profile', compact('profile'));
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
