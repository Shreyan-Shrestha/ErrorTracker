<?php
use App\Http\Controllers\Api\ApplicationController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('application')->group(function () {
Route::apiResource('/', ApplicationController::class);
});