<?php

namespace App\Http\Controllers\Admin\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class handles confirmation if funds has sended
class ConfirmController extends Controller
{
    public function index(Request $request) {
        $update = Donation::find($request->id);
        $update->status = "COMPLETED";
        $update->save();

        return \Redirect::back();
    }
}
