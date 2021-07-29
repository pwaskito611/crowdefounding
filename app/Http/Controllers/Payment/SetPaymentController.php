<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Http\Request;
use App\Models\Payment;

//this class is
class SetPaymentController extends PaymentController
{
    public function index(Request $request) {
        //validate use input
        $this->validateUserInput($request);
        //get access token before set payment
        $accessToken = $this->getAccessToken();
        //set and get payment url from paypal api
        $paymentUrl = $this->createOrderPaypal($accessToken, $request->amount);
        
        $payment = new Payment;
        $payment->user_id = \Auth::user()->id;
        $payment->donation_id = $request->id;
        $payment->status = 'CREATED';
        $payment->paypal_payment_id = $paymentUrl->id;
        $payment->amount = $request->amount;
        $payment->save();

        return view('pages.payment.instruction', [
            'paymentUrl' => $paymentUrl->links[1]->href,
            'payment' => $payment
        ]);
    }

    private function validateUserInput($request) {
        //validate user input
        $validated = $request->validate([
            'id' => 'required|integer',
            'amount' => 'required|integer',
        ]);
    }

    private function createOrderPaypal($accessToken, $amount) {
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v2/checkout/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n\n  \"intent\": \"CAPTURE\",\n\n  \"purchase_units\": [\n\n    {\n\n      \"amount\": {\n\n        \"currency_code\": \"USD\",\n\n        \"value\": " . $amount . " \n\n      }\n\n    }\n\n  ]\n\n}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer ' . $accessToken;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);
        
        return $result;
    }
}
