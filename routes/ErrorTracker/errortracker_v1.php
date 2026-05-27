<?php

use App\Http\Controllers\Api\ErrorTrackerController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum, throttle:api')->group(function(){
    Route::post('/error/markfixed/{id}', [ErrorTrackerController::class, 'markFixed'])->name('errortracker.markfixed');
    Route::apiResource('ErrorReport', ErrorTrackerController::class);
});