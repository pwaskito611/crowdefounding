<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//this class handles password updates
class UpdatePasswordController extends Controller
{
    public function index(Request $request) {

        $this->validateUserInput($request);

        $request->session()->put('passwordChanged', false);//

        if (Hash::check($request->password, \Auth::user()->password)) {// make sure user input righ old password
            $update = User::find(\Auth::user()->id);
            $update->password = Hash::make($request->newPassword);
            $update->save();

            //set session variabel for give message to user that they success change password
            //look resource/views/includes/message.blade.php
            $request->session()->put('passwordChanged', true);
        }

        return \Redirect('account');
    }

    private function validateUserInput($request) {
        $validated = $request->validate([
            'newPassword' => 'required|
                min:8|
               required_with:confirmPassword|
               same:confirmPassword',
            'password' => 'required',
        ]);
    }
}
