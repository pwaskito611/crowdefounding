<?php

namespace App\Http\Controllers\Donation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//this class handles to show page of campaign creation
class CreateController extends Controller
{
    public function index() {
        return view('pages.donation.create');
    }
}
