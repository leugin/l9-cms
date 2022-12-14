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
            ->name('management.login');
        Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->name('management.login.create')
        ;

    });

    Route::group(['middleware'=>['auth:admin']], function() {
        Route::get('dashboard', [DashboardController::class, 'show'])
            ->name('management.dashboard');
        Route::group(['prefix'=>'admins'], function ()
        {
            Route::get('', [\App\Services\Management\Http\Controllers\AdminController::class,'index'])
                ->name('management.admins.index')
                ->middleware('can:management-admins-index')
            ;

            Route::get('create', [\App\Services\Management\Http\Controllers\AdminController::class,'create'])
                ->name('management.admins.create')
                ->middleware('can:management-admins-create');

            Route::get('edit/{admin}', [\App\Services\Management\Http\Controllers\AdminController::class,'edit'])
                ->name('management.admins.edit')
                ->middleware('can:management-admins-edit');

            Route::put('{admin}', [\App\Services\Management\Http\Controllers\AdminController::class,'update'])
                ->name('management.admins.update')
                ->middleware('can:management-admins-update');

            Route::post('', [\App\Services\Management\Http\Controllers\AdminController::class,'store'])
                ->name('management.admins.store')
                ->middleware('can:management-admins-store');

            Route::get('datatable', [\App\Services\Management\Http\Controllers\AdminController::class, 'datatable'])
                ->name('management.admins.datatable')
                ->middleware('can:management-admins-datatable')
            ;
        });


    });

});
