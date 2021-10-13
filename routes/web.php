<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountOverviewController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartJsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Route::middleware(['auth', 'auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource routes
    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('overview', AccountOverviewController::class);
        Route::resource('create_account', AccountController::class);
        Route::resource('upload', FileController::class);
        Route::resource('statistic', StatisticController::class);
    });

    Route::group(['middleware' => 'role:teacher', 'prefix' => 'teacher', 'as' => 'teacher.'], function () {

    });

    Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function () {

    });
});

