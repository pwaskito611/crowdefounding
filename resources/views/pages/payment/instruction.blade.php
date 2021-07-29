@extends('layouts.plain')

@section('content')
    <center>
        <h2 class="mb-2" style="margin-top: 100px">
            1. Press the link button below to continue the payment
        </h2>
        <a href="{{$paymentUrl}}" target="_blank" class="btn btn-secondary">Open paypal checkout page</a>

        <h2 class="mb-2 mt-4" style="margin-top: 200px">
            2. if you have finished transaction confrim by click button bellow
        </h2>
        <a href="{{url('payment/check/' . $payment->paypal_payment_id)}}" class="btn btn-secondary"
        style="padding-right: 95px; padding-left: 95px;">Confirm</a>

        <br>
        <h4 class="mb-2 mt-4" style="margin-top: 200px">
            if you want cancel contribute
        </h4>
        <a href="{{url('donation/detail/' . $payment->donation_id)}}" class="btn btn-danger mb-5"
            style="padding-right: 100px; padding-left: 100px;">Cancel</a>
    </center>
@endsection