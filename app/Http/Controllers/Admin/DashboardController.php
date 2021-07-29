<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Payment;

//this class handles show admin dashboard page
class DashboardController extends Controller
{
    public function index() {
        $donation = Donation::whereRaw('created_at between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()')
        ->count();

        $donor =  Payment::whereRaw('created_at between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()')
        ->where('status', 'SUCCESS')
        ->count();

        $fundsSended = Donation::whereRaw('created_at between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()')
        ->where('status', 'COMPLETED')
        ->sum('collected');

        $fundsHeld = Donation::whereRaw('created_at between (CURDATE() - INTERVAL 1 MONTH ) and CURDATE()')
        ->orWhere('status', 'OPEN')
        ->orWhere('status', 'CLOSED')
        ->orWhere('status', 'DELAYED PICK UP')
        ->sum('collected');


        return view('pages.admin.dashboard', [
            'donation' => $donation,
            'donor' => $donor,
            'fundsSended' => $fundsSended,
            'funsHeld' => $fundsHeld
        ]);
    }
}
