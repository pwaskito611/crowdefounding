<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Donation;

//this class is handles confirmation user payment for contribute in campaign
//this class will change status of payment from "CREATED" to "SUCCESS" from database
//if user finish payment
class CheckController extends PaymentController
{
    public function index($id) {
        //get access token before set payment
        $accessToken = $this->getAccessToken();

        //check status user payment
        $status = $this->checkStatus($accessToken, $id);

        $payment = Payment::where('paypal_payment_id', $id)->first();

        if($status->status == "APPROVED" || $status->status == "COMPLETED") {
            $payment->status = "SUCCESS";
            $payment->save();

            $donation = Donation::find($payment->donation_id);
            $donation->collected += $payment->amount;
            $donation->save();

            session(['_message' => 'Your payment is success']);
            return \Redirect('donation/detail/' . $donation->id);
        }

        session(['_message' => 'You are not completed payment']);
        return \Redirect('payment/check-1/' . $id . '/' . $payment);
    } 
}
