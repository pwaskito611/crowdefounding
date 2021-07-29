<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

//this class handles update name
class UpdatePersonalInformationController extends Controller
{
    public function index(Request $request) {
        $this->validateUserInput($request);

        $update = User::find(\Auth::user()->id);
        $update->name = $request->name;
        $update->save();

        return \Redirect('account');
    }

    private function validateUserInput($request) {
        $validated = $request->validate([
            'name' => 'required|max:40',
        ]);
    }
}
