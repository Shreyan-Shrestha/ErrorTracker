<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ApplicationController;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\auth\UserAuthenticationController;
use App\Http\Controllers\Auth\WebLogin;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\ErrorReportController;
use App\Http\Controllers\Web\ProblemController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\UserRecordsController;

Route::get('/', [ErrorReportController::class, 'index']);


Route::view('/login', 'auth.login')->name('login');
Route::post('/login', WebLogin::class)->name('user.login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [UserAuthenticationController::class, 'register'])->name('user.register');
Route::get('/registerform', [UserAuthenticationController::class, 'registerForm'])->name('user.registerform');
Route::post('/logout', Logout::class)->name('logout')->middleware('login');

Route::middleware('login')->group(function () {

    Route::prefix('errors')->name('errors.')->group(function () {
        Route::get('/', [ErrorReportController::class, 'index'])->name('index');
        Route::get('/report',[ErrorReportController::class, 'create'])->name('add');
        Route::get('/edit/{error}', [ErrorReportController::class, 'edit'])->name('edit');
        Route::patch('/rootCauseAnalysis/{error}',[ErrorReportController::class,'analysis'])->name('analysis');
        Route::patch('/edit/{error}', [ErrorReportController::class, 'update'])->name('update');
        Route::post('/', [ErrorReportController::class, 'store'])->name('create');
        Route::patch('/markFixed/{error}', [ErrorReportController::class, 'markFixed'])->name('markFixed');
        Route::delete('/delete/{error}', [ErrorReportController::class, 'destroy'])->name('delete');
    });

    Route::prefix('projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::post('/', [ProjectController::class, 'store'])->name('create');
        Route::patch('/{project}', [ProjectController::class, 'update'])->name('edit');
        Route::delete('/delete/{project}', [ProjectController::class, 'destroy'])->name('delete');
    });

    Route::prefix('problems')->name('problems.')->group(function() {
        Route::get('/', [ProblemController::class, 'index'])->name('index');
        Route::post('/', [ProblemController::class,'store'])->name('create');
        Route::patch('/{problem}', [ProblemController::class, 'update'])->name('edit');
        Route::delete('/delete/{problem}',[ProblemController::class,'destroy'])->name('delete');
    });

    Route::prefix('category')->name('category.')->group( function(){
        Route::post('/', [CategoryController::class, 'store'])->name('create');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('edit');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::prefix('users')->name('users.')->group(function(){
        Route::get('/', [UserRecordsController::class, 'index'])->name('index');
        Route::post('/', [UserRecordsController::class, 'store'])->name('create');
        Route::get('/{user}', [UserRecordsController::class, 'show'])->name('show');
        Route::patch('/{user}', [UserRecordsController::class, 'update'])->name('edit');
        Route::delete('/delete/{user}',[UserRecordsController::class, 'destroy'])->name('delete');
    });
    
});





Route::resource('applications', ApplicationController::class)->middleware('login');
