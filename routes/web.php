<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\XeroController::class, 'index'])->middleware(['auth', 'verified'])->name('xero.auth.success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
 * We name this route xero.auth.success as by default the config looks for a route with this name to redirect back to
 * after authentication has succeeded. The name of this route can be changed in the config file.
 */

Route::get('/manage/xero', [\App\Http\Controllers\XeroController::class, 'index'])->name('xero.auth.success');
require __DIR__.'/auth.php';
Route::get('/xero/auth/callback', \Webfox\Xero\Controllers\AuthorizationCallbackController::class)->name('xero.auth.callback');
//require __DIR__.'/auth.php';


