<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\HostController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('welcome');
});

Route::post('guest/access{inviteLink}', [DoorController::class, 'twoFactorVerify'])->name('guest.twoFactorVerify');
Route::post('guest/access{inviteLink}/request-2fa', [DoorController::class, 'requestTwoFactor'])->name('guest.requestTwoFactor');
Route::get('guest/access/{inviteLink}', [DoorController::class, 'accessController'])->middleware('signed')->name('guest.access');

Route::get('/host/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    //TEST ROUTE
    Route::get('host/dashboard', [HostController::class, 'dashboard'])->name('host.dashboard');
    Route::post('host/dashboard', [HostController::class, 'addGuest'])->name('host.addGuest');
    //Route::get('guest/access_granted', [DoorController::class, 'twoFactorVerify'])->name('guest.access_granted');
    Route::get('host/allGuests', [HostController::class, 'allGuests'])->name('host.allGuests');
    Route::get('host/guest-show{guest}', [HostController::class, 'showGuest'])->name('host.guest-show');
    Route::put('host/guest-show{guest}', [HostController::class, 'updateGuest'])->name('host.updateGuest');
    Route::delete('host/guest-show{guest}', [HostController::class, 'deleteGuest'])->name('host.deleteGuest');
    Route::get('host/account', [HostController::class, 'showAccount'])->name('host.account');
    Route::put('host/account/{id}', [HostController::class, 'updateAccount'])->name('host.updateAccount');
    Route::post('host/account{id}', [HostController::class, 'sendInvite'])->name('host.sendInvite');
    Route::delete('host/account/{id}', [Hostcontroller::class, 'deleteAccount'])->name('host.deleteAccount');
    Route::get('host/allActivities', [HostController::class, 'showAuditLogs'])->name('host.allActivities');
    Route::get('host/search', [HostController::class,'search'])->name('host.search');
});

require __DIR__.'/auth.php';
