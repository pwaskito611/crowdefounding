<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

//this class handles to show page of campaign changing form
class EditController extends Controller
{
    public function index(Request $request) {
        $item = Donation::where('id', $request->id)->first();

        if(\Auth::user()->id !== $item->creator_id) {
            abort(403);
        }

        return view('pages.donation.edit', [
            'item' => $item
        ]);
    }
}
