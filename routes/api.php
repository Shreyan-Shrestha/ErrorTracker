<?php

use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ErrorTrackerController;
use App\Http\Controllers\Api\ProjectController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\api\Register;
use App\Http\Controllers\Auth\Login;
use App\Models\User;
use Illuminate\Validation\ValidationException;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::apiResource('application', ApplicationController::class);

    Route::patch('project/updateStatus/{id}', [ProjectController::class, 'updateStatus'])->name('project.updateStatus');
    Route::apiResource('project', ProjectController::class);

    Route::post('/error/markfixed/{id}', [ErrorTrackerController::class, 'markFixed'])->name('errortracker.markfixed');
    Route::apiResource('ErrorReport', ErrorTrackerController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', Register::class);

Route::post('/login', Login::class);

Route::post('/issue', function (Request $request): \Illuminate\Http\JsonResponse {
    $request->validate([
        'email'       => ['required', 'email'],
        'password'    => ['required'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    $tokenExpiration = Carbon::now()->addMinutes(5);
    $token = $user->createToken('access_token', ['*'], $tokenExpiration);

    return response()->json([
        'message' => 'Token issued successfully',
        'access_token' => $token->plainTextToken,
        'expires_at' => $tokenExpiration,
    ]);
});
