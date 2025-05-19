<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView(){
        return view('auth.login');
    }

    public function login(Request $request){
        if ($request->isMethod('POST')){
            $creds = $request->validate([
                'email' => ['required', 'email',],
                'password'=>['required'],
            ]);

            if(Auth::attempt($creds , true)){
                $request->session()->regenerate();
                return redirect()->route('home');
            } else {
                return back()->withErrors('Provided Credentials Do not match.');
            }
        }
    }

    public function logout(){
        if (Auth::check()){
            Auth::logout();
        }
        return redirect()->route('login');
    }
}
