<?php

use App\Http\Controllers\Api\V1\ErrorReportController;
use App\Http\Controllers\Api\V1\ProblemController;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Auth\api\Login;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\api\Register;
use App\Http\Controllers\Web\DashboardController;
use App\Models\User;
use Illuminate\Validation\ValidationException;


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    Route::prefix('project')->name('project.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{id}', [ProjectController::class, 'show'])->name('show');
        Route::patch('/{id}', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProjectController::class, 'delete'])->name('delete');
        Route::patch('/updateStatus/{id}', [ProjectController::class, 'updateStatus'])->name('updateStatus');
    });

    Route::prefix('error')->name('error.')->group(function () {
        Route::get('/', [ErrorReportController::class, 'index'])->name('index');
        Route::post('/', [ErrorReportController::class, 'store'])->name('store');
        Route::get('/{id}', [ErrorReportController::class, 'show'])->name('show');
        Route::patch('/{id}', [ErrorReportController::class, 'update'])->name('update');
        Route::delete('/{id}', [ErrorReportController::class, 'delete'])->name('delete');
        Route::post('/markfixed/{id}', [ErrorReportController::class, 'markFixed'])->name('markfixed');
    });

    Route::prefix('problem')->name('problem.')->group(function () {
        Route::get('/', [ProblemController::class, 'index'])->name('index');
        Route::post('/', [ProblemController::class, 'store'])->name('store');
        Route::get('/{id}', [ProblemController::class, 'show'])->name('show');
        Route::patch('/{id}', [ProblemController::class, 'update'])->name('update');
        Route::delete('/{id}', [ProblemController::class, 'delete'])->name('delete');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', Register::class);

Route::post('/login', Login::class);

Route::post('/issueToken', function (Request $request): \Illuminate\Http\JsonResponse {
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
