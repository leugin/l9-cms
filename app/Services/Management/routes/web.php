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

use App\Data\Enums\AdminManagementRoute;
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
                ->name(AdminManagementRoute::DATA_VIEW->value)
                ->middleware(AdminManagementRoute::DATA_VIEW->getMiddlewarePermission())
            ;

            Route::get('create', [\App\Services\Management\Http\Controllers\AdminController::class,'create'])
                ->name(AdminManagementRoute::CREATE->value)
                ->middleware(AdminManagementRoute::CREATE->getMiddlewarePermission());

            Route::post('', [\App\Services\Management\Http\Controllers\AdminController::class,'store'])
                ->name(AdminManagementRoute::STORE->value)
                ->middleware(AdminManagementRoute::CREATE->getMiddlewarePermission());


            Route::get('edit/{admin}', [\App\Services\Management\Http\Controllers\AdminController::class,'edit'])
                ->name(AdminManagementRoute::EDIT->value)
                ->middleware(AdminManagementRoute::EDIT->getMiddlewarePermission());

            Route::put('{admin}', [\App\Services\Management\Http\Controllers\AdminController::class,'update'])
                ->name(AdminManagementRoute::UPDATE->value)
                ->middleware(AdminManagementRoute::EDIT->getMiddlewarePermission())
            ;


            Route::delete('{admin}', [\App\Services\Management\Http\Controllers\AdminController::class,'delete'])
                ->name(AdminManagementRoute::DELETE->value)
                ->middleware(AdminManagementRoute::DELETE->getMiddlewarePermission())
            ;

            Route::get('datatable', [\App\Services\Management\Http\Controllers\AdminController::class, 'datatable'])
                ->name(AdminManagementRoute::DATA->value)
                ->middleware(AdminManagementRoute::DATA->getMiddlewarePermission())
            ;
        });


    });

});
