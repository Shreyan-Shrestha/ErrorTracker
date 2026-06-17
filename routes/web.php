<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\auth\UserAuthenticationController;
use App\Http\Controllers\Auth\WebLogin;
use App\Http\Controllers\Web\ErrorTrackerController;
use App\Http\Controllers\Web\ProjectController;

Route::get('/', [ErrorTrackerController::class, 'index']);


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', WebLogin::class)->name('user.login');
Route::view('/register', 'auth.register')->name('register');
Route::get('/registerform', [UserAuthenticationController::class, 'registerForm'])->name('registerform');
Route::post('/logout', Logout::class)->name('logout')->middleware('login');

Route::middleware('login')->group(function () {

    Route::prefix('errors')->name('errors.')->group(function () {
        Route::get('/', [ErrorTrackerController::class, 'index'])->name('index');
        Route::post('/', [ErrorTrackerController::class, 'store'])->name('create');
        Route::delete('/delete/{error}', [ErrorTrackerController::class, 'destroy'])->name('delete');
    });

    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::post('/', [ProjectController::class, 'store'])->name('create');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('edit');
        Route::delete('/delete/{project}', [ProjectController::class, 'destroy'])->name('delete');
    });

    Route::get('/users', function () {
        return view('users/index');
    });
});





Route::resource('applications', ApplicationController::class)->middleware('login');
