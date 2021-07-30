<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class is handles show page of campaign 
class ShowController extends Controller
{
    public function index() {
        $items = Donation::where('status', 'OPEN')
        ->paginate(9);

        return view("pages.donation.show", [
            'items' => $items
        ]);
    }
}
