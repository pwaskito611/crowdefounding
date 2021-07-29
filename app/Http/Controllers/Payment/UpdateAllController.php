<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Donation;

//this class is same purpose as CheckController class but this class has general
//target. i mean this class  check all payment status and update to database
class UpdateAllController extends PaymentController
{
    public function index() {
        
        $payment = Payment::where('status', 'CREATED')->get();

        $accessToken = $this->getAccessToken();
        
        foreach($payment as $p) {
            $status = $this->checkStatus($accessToken, $p->paypal_payment_id);

            if($p->status == "APPROVED" || $p->status == "COMPLETED") {
                $update = Payment::find($p->id);
                $update->status = "SUCCESS";
                $update->save();

                $donation = Donation::find($p->donation_id);
                $donation->collected += $update->amount;
                $donation->save();
            }

            if($p->created_at < date("Y-m-d H:i:s", time() - 3600)){
                $update = Payment::find($p->id);
                $update->status = "CANCEL";
                $update->save();
            }
        }

        return \Redirect::back();
    }

    
}
