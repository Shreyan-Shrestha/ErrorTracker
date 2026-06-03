<?php

use App\Http\Controllers\ErrorTrackerController;
use Illuminate\Support\Facades\Route;
use App\Models\ErrorTracker;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\auth\UserAuthenticationController;
use App\Http\Controllers\Auth\WebLogin;

Route::get('/', [ErrorTrackerController::class, 'index']);

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', WebLogin::class)->name('user.login');
Route::view('/register', 'auth.register')->name('register');
Route::get('/registerform',[UserAuthenticationController::class, 'registerForm'])->name('registerform');
Route::post('/logout', Logout::class)->name('logout')->middleware('login');

Route::prefix('errors')->name('errors.')->group(function() {
Route::post('/store', [ErrorTrackerController::class, 'store'])->name('store');
});



Route::resource('applications', ApplicationController::class)->middleware('login');