<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\TakeFundsRequest;

//this class is handles to make request to admind to take funds
class RequestTakeFundsController extends Controller
{
    public function index(Request $request) {
        
        $validated = $request->validate([
            'id' => 'required|integer',
            'bankAccount' => 'required|integer',
        ]);

        $donation = Donation::find($request->id);

        if($donation->creator_id != \Auth::user()->id) {
            return;
        }

        $donation->status = "DELAYED PICK UP";
        $donation->save();

        $takeFundsRequest = new TakeFundsRequest;
        $takeFundsRequest->donation_id = $request->id;
        $takeFundsRequest->bank_account = $request->bankAccount;
        $takeFundsRequest->save();

        //set session variabel for give message to user that their withrawal is in process
        //look resource/views/includes/message.blade.php
        session(['_message' => 'Your withdrawal is in process']);

        return \Redirect::back();
    }
}
