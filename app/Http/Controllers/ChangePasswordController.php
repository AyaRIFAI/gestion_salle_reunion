<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\matchOldPassword;

class ChangePasswordController extends Controller
{
   
    public function updatePasswordForm($id){
        return view('userViews.updatePasswordForm',['id'=>$id]);
    }
    public function updatePassword(Request $request, $id){
        $request->validate(['previous-password'=>['bail', 'required', 'current_password'], 
        'password'=>['bail', 'required', 'confirmed']]);
        $user=User::findOrFail($id);
        $user->password = $request->password;
        
        $user->save();
    }
}
