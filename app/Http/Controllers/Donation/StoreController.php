<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class is handles store data to databases from user input in campaign creation form
class StoreController extends Controller
{
    public function index(Request $request) {
        //validation user input
        $this->valideUserInput($request);
        //store and get image path from user upload
        $photo_path = $this->handleImage($request);

        $donation = new Donation;
        $donation->creator_id = \Auth::user()->id;
        $donation->title = $request->title;
        $donation->description = $request->description;
        $donation->target = $request->target;
        $donation->photo_path = $photo_path;
        $donation->status = "OPEN"; 
        $donation->save();

        return \Redirect('/donation/detail/' . $donation->id);
    }

    private function valideUserInput($request) {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'target' => 'required|integer|min:0.1',
            'image' => 'image|max:1000'
        ]);
    }

    private function handleImage($request) {
       if($request->image !== null) {
            $path = $request->file('image')->store('public/asset/donation');
            return "storage/" . substr($path, 7);
       }else{
           return null;
       }
    }

}
