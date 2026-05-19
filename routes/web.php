<?php

use App\Http\Controllers\ErrorTrackerController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Models\ErrorTracker;
use App\Http\Controllers\ApplicationController;

Route::get('/', [ErrorTrackerController::class, 'index']);

Route::prefix('errors')->name('errors.')->group(function() {
Route::post('/store', [ErrorTrackerController::class, 'store'])->name('store');
});

Route::resource('applications', ApplicationController::class);