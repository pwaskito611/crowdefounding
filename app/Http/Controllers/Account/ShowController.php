<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//this class handles show page of user account
class ShowController extends Controller
{

    public function index() {
        return view("pages.account");
    }

}
