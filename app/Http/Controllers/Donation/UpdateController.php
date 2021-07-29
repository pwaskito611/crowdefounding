<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class is handles update data of campaign
class UpdateController extends Controller
{
    public function index(Request $request) {
        //validation user input
        $this->valideUserInput($request);
        //store and get image path from user upload
        $photo_path = $this->handleImage($request);

        $donation = Donation::find($request->id);

        if(\Auth::user()->id !== $donation->creator_id) {
            abort(403);
        }

        $donation->creator_id = \Auth::user()->id;
        $donation->title = $request->title;
        $donation->description = $request->description;
        
        if($request->image !== null){
            $donation->photo_path = $photo_path;
        }

        $donation->save();

        return \Redirect('donation/detail/' . $request->id);
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
