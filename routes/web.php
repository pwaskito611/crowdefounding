<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
Route::get('/', [HomeController::class, 'index']);

// donation or campaign router
Route::prefix('donation')->group(function () {
    Route::get('/', [Donation\ShowController::class, 'index']);
    Route::get('/detail/{id}', [Donation\DetailController::class, 'index']);
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/create', [Donation\CreateController::class, 'index']);
        Route::post('/store', [Donation\StoreController::class, 'index']);
        Route::get('/edit', [Donation\EditController::class, 'index']);
        Route::put('/update', [Donation\UpdateController::class, 'index']);
        Route::put('/close', [Donation\CloseController::class, 'index']);
        Route::put('/reopen', [Donation\ReopenController::class, 'index']);
        Route::post('/take-funds-request', [Donation\RequestTakeFundsController::class, 'index']);
    });
 
});

//router to see user see tyey own  campaign or danation
Route::get('my-campaign', [Donation\MyCampaignController::class, 'index'])->middleware(['auth']);

//router all about account
Route::prefix('account')->middleware(['auth'])->group(function () {
   
    Route::get('/', [Account\ShowController::class, 'index']);
    Route::put('/update/photo-profile', [Account\UpdatePhotoProfileController::class, 'index']);
    Route::put('/update/personal-information', [Account\UpdatePersonalInformationController::class, 'index']);
    Route::put('/update/password', [Account\UpdatePasswordController::class, 'index']);

});

Route::prefix('payment')->middleware(['auth'])->group(function () {
   
    Route::post('/create', [Payment\SetPaymentController::class, 'index']);
    Route::get('/check/{id}', [Payment\CheckController::class, 'index']);
    Route::get('/update-all', [Payment\UpdateAllController::class, 'index']);

});



//admin router
Route::middleware(['auth', 'admin'])->group(function () {
   
    Route::get('/admin', [Admin\DashboardController::class, 'index']);

    Route::get('/admin-send-funds', [Admin\SendFund\ShowController::class, 'index']);
    Route::put('/admin/send-funds/confirm', [Admin\SendFund\ConfirmController::class, 'index']);
    
});


require __DIR__.'/auth.php';
 