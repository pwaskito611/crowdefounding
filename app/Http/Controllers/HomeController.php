<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

//this class handle home page
class HomeController extends Controller
{
    public function index() {
        $items = Donation::where('status', 'OPEN')
        ->limit(3)
        ->get();

        return view("pages.home", [
            'items' => $items
        ]);
    }
}
