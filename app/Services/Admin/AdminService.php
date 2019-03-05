<?php

namespace App\Services\Admin;

use App\User;
use Illuminate\Support\Facades\Hash;

class AdminService{

    static public function changePassword($request){

        $currentPassword = User::find(auth()->user()->password);
        if(Hash::check($request->new_password, $currentPassword)){
            $admin = User::find(auth()->user()->id);
            $admin->password = Hash::make($request->new_password);
            $admin->save();
            return ['success', 'password changed successfully'];
        }else return ['failure', 'old password is incorrect'];
    }
}