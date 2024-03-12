<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getLogin() {

        if(auth('web')->user()){
            return redirect()->route('dashboard');
        }elseif(auth('admin')->user()){
            return redirect()->route('admin.dashboard');
        }
        else {
            return view('admin.login');
        }
    }

    public function login(Request $request) {

        // Validate the form by the rules defined in the $rules array
        $this->validate($request, [
            'login' => 'required|string',
            'password' => 'required|min:6'
        ]);

        $checkEmail = Auth::guard('admin')->attempt(['email' => $request['login'], 'password' => $request['password']]);
        $checkUsername = Auth::guard('admin')->attempt(['username' => $request['login'], 'password' => $request['password']]);

        if ( $checkEmail || $checkUsername ) {

            return redirect()->route('admin.dashboard')->with('success', ' Welcome back: '.Auth::guard('admin')->user()->name);

        }else{

            return redirect()->back()->with('error', 'Invaild email or password');

        }


    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }



    public function forgot_password(){
        return view('admin.forgot-password');
    }
}
