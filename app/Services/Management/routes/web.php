<?php

/*
|--------------------------------------------------------------------------
| Service - Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Services\Management\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Services\Management\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'management'], function() {

    Route::group(['prefix' => 'auth', 'middleware'=>['guest:admin']], function() {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');
    });

    Route::group(['middleware'=>['auth:admin']], function() {
        Route::get('dashboard', [DashboardController::class, 'show'])
            ->name('management.dashboard');
    });

});
