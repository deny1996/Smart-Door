<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});
// Guest routes
Route::post('guest/access{inviteLink}', [DoorController::class, 'twoFactorVerify'])->name('guest.twoFactorVerify');
Route::get('guest/access/{inviteLink}', [DoorController::class, 'accessController'])->name('guest.access');


// Host routes
Route::middleware('auth')->group(function () {
    Route::get('host/dashboard', [HostController::class, 'dashboard'])->name('host.dashboard');
    Route::post('host/dashboard', [HostController::class, 'addGuest'])->name('host.addGuest');
    Route::get('host/allGuests', [HostController::class, 'allGuests'])->name('host.allGuests');
    Route::get('host/guest-show{guest}', [HostController::class, 'showGuest'])->name('host.guest-show');
    Route::put('host/guest-show{guest}', [HostController::class, 'updateGuest'])->name('host.updateGuest');
    Route::delete('host/allGuests{id}', [HostController::class, 'deleteGuest'])->name('host.deleteGuest');
    Route::get('host/account', [HostController::class, 'showAccount'])->name('host.account');
    Route::put('host/account/{id}', [HostController::class, 'updateAccount'])->name('host.updateAccount');
    Route::post('host/account{id}', [HostController::class, 'sendInvite'])->name('host.sendInvite');
    Route::delete('host/account/{id}', [Hostcontroller::class, 'deleteAccount'])->name('host.deleteAccount');
    Route::get('host/allActivities', [HostController::class, 'showAuditLogs'])->name('host.allActivities');
    Route::get('host/search', [HostController::class,'search'])->name('host.search');
    Route::get('host/filterNachName', [HostController::class, 'filterNachName'])->name('host.filterNachName');
    Route::delete('host/guest-show{guest}', [HostController::class, 'deleteLink'])->name('host.deleteLink');
    Route::post('host/guest-show{guest}', [HostController::class, 'resendInvite'])->name('host.resendInvite');
});

require __DIR__.'/auth.php';
