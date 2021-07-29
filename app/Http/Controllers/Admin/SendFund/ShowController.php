<?php

namespace App\Http\Controllers\Admin\SendFUnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class handles show the campaign whose funds user want to take
class ShowController extends Controller
{
    public function index(Request $request) {
        $items = Donation::join('users',
        'users.id', '=', 'donation.creator_id')
        ->join('take_funds_requests',
        'take_funds_requests.donation_id', '=', 'donation.id')
        ->where('status', 'DELAYED PICK UP')
        ->paginate(5);

        return view('pages.admin.send-fund', [
            'items' => $items
        ]);
    }
}
