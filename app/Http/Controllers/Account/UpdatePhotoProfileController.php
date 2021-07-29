<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

//this class handel update photo profile
class UpdatePhotoProfileController extends Controller
{
    public function index(Request $request) {
        $this->validateUserInput($request);
        $photoPath = $this->storeImage($request);//store image to storage and get path

        $update = User::find(\Auth::user()->id);
        $update->photo_path = $photoPath;
        $update->save();

        return \Redirect('account');
    }

    private function validateUserInput($request) {
        $validated = $request->validate([
            'image' => 'required|image|max:1000',
        ]);
    }

    private function storeImage($request) {
        if($request->image !== null) {//make sure image is uploaded
            $path = $request->file('image')->store('public/asset/profile');
            return "storage/" . substr($path, 7);
       }else{
           return null;
       }
    }
}
