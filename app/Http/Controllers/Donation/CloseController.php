<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class handles user to close their campaign
class CloseController extends Controller
{
    public function index(Request $request) {
        $donation = Donation::find($request->id);

        if(\Auth::user()->id !== $donation->creator_id) {
            abort(403);
        }

        $donation->status = "CLOSED";
        $donation->save();

        return \Redirect('donation/detail/' . $request->id);
    }
}
