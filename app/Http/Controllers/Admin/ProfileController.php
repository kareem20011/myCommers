<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit() {
        return  view('admin.pages.profile');
    }

    public function  update(Request $request) {

        $request->validate([
            'username' => 'unique:App\Models\Admin|min:2',
            'email' => 'unique:App\Models\Admin|min:2',
            'name' => 'min:2'
        ]);

        $profile = Admin::find(auth('admin')->user()->id);

        if ($request->has('image')) {
            $old = $profile->getFirstMedia('images');
            if ($old) {
                $old->delete();
            }
            $profile->addMediaFromRequest('image')->toMediaCollection('images');


        }

        $profile->update($request->except('_token'));

        return redirect()->back();

    }

    public function changePassword(Request $request){

        $request->validate([
            'currentPassword' => 'required|min:8',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|min:8',
        ]);

        if ($request->password !=  $request->confirmPassword) {
            return redirect()->back()->with("confirmError", "Your assword dosn't match");
        }

        $check = Hash::check($request->currentPassword, auth('admin')->user() -> password);

        if ($check) {
            Admin::where('id', auth('admin') -> user()-> id)->update([

                'password' => Hash::make( $request->password) || auth('admin')->user() -> password,

            ]);
            return redirect()->back()->with("success", "The password has been changed successfully");
        }else{

            return redirect()->back()->with("worngPassword", "Password is wrong, try again!");

        }

    }

    public function confirmDelete(){
        return view('admin.confirmDelete');
    }

    public function destroy(Request $request){
        if (Hash::check($request->password, auth('admin')->user()->password)) {
            Admin::where('id', auth('admin')->user()->id)->delete();
            return redirect()->route('admin.login');
        }
        return redirect()->back()->with('error', 'Worng  password!');
    }
}
