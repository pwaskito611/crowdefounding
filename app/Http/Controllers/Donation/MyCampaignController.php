<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this page is handles user to see their own campaign
class MyCampaignController extends Controller
{
    public function index() {
        $items = Donation::where('creator_id', \Auth::user()->id)
        ->paginate(9);

        return view("pages.donation.my-campaign", [
            'items' => $items
        ]);
    }
}
