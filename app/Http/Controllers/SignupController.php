<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use App\Mail\OtpMail;

use App\Models\User;

class SignupController extends Controller
{
    public function signupView(){
        return view('auth.signup');
    }

    public function create(Request $request){
        if($request->isMethod('post')){

            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'last_name' => ['required', 'string', 'max:45'],
                'first_name' => ['required', 'string', 'max:45'],
                'phone' => ['required', 'string', 'max:45'],
            ]);

            $user = new User();

            $user->name = $request->input('first_name')." ".$request->input('last_name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = $request->input('_token');

            $user->save();

            $otp = rand('100000','999999');

            session(['otp'=>$otp , 'email'=>$user->email]);

            Mail::to($user->email)->send(new OtpMail($otp));
        }
    }

    public function otpVerification(Request $request){
        if($request->isMethod('post')){
            $user = User::where('email' , '=',session('email'))->first();
            if (session('otp') == ((integer) $request->input('otp'))){
                $user->email_verified_at = now();
                $user->save();
                return redirect('login');
            } else {
                $user->forceDelete();
                return redirect('signup')->withErrors('Verification Failed.');
            }
        }
    }
}
