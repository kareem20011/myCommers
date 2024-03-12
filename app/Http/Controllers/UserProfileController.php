<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(Request $request){
        User::where('id', auth()->user()->id)->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'role'=>$request->role,
            'address'=>$request->address
        ]);

        return redirect()->route('profile.edit');
    }
}
