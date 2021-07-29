<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class handles show pages of detail of the campaign
class DetailController extends Controller
{
    public function index($id) {
        $item = Donation::where('id', $id)
        ->with(['user'])
        ->first();

        return view("pages.donation.detail", [
            'item' => $item
        ]);
    }
}
