<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/version', function () {
    return response()->json(['version' => '1.0']);
});

Route::middleware('auth:sanctum, throttle:api')->group(function () {
    Route::patch('project/updateStatus/{id}', [ProjectController::class, 'updateStatus'])->name('project.updateStatus');
    Route::apiResource('project', ProjectController::class);
});
