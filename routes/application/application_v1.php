<?php
use App\Http\Controllers\Api\ApplicationController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum, throttle:api')->group(function () {
Route::apiResource('application', ApplicationController::class);
});