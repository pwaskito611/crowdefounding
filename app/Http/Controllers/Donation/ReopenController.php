<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class is handles re-open closed campaign(like continou)
class ReopenController extends Controller
{
    public function index(Request $request) {
        $donation = Donation::find($request->id);

        if(\Auth::user()->id !== $donation->creator_id) {
            abort(403);
        }
        
        //make sure user didnt open campaigns whose funds have 
        //been or are in the process of being sent
        if($donation->status != "CLOSED") {
            return;
        }

        $donation->status = "OPEN";
        $donation->save();

        return \Redirect('donation/detail/' . $request->id);
    }
}
