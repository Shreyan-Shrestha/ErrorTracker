<?php

use App\Http\Controllers\ErrorTrackerController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Models\ErrorTracker;
use Carbon\Carbon;
use RohanAdhikari\NepaliDate\NepaliDate;

Route::get('/', function () {
    $now = ErrorTracker::latest()->first();
    return view('welcome', compact('now'));
});

Route::post('/store', [ErrorTrackerController::class, 'store'])->name('errors.store');
