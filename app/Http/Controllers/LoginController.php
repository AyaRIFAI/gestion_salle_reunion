<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    public function login(){
        return view('userViews.login');
    }   
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['bail','required', 'email'],
            'password' => ['bail','required'],
        ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user=Auth::user();
        if($user->admin){
            session(['name' => $user->name, 'isAdmin'=>$user->admin, 'admin_id'=>$user->id]);
        }
        else{
            session(['name' => $user->name, 'isAdmin'=>$user->admin, 'prof_id'=>$user->prof->id]);

        }
        return redirect()->intended('/home');
    }
    return back()->withErrors([
        'failed' => 'Les données que vous avez entrées ne correspondent aux données enregitrées dans notre base de donnée',
    ])->onlyInput('failed');
    }
    public function goHome()
    {
        if(session('isAdmin')){
            return view('adminViews.home');
        }
        if(!session('isAdmin')){
            return view('profViews.home');
        }
    }
}