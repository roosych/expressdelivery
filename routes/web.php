<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function (){
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::group(['prefix' => 'dashboard'], function (){
        Route::get('/', [IndexController::class, 'index'])->name('dashboard.index');

        Route::group(['prefix' => 'users'], function (){
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('add', [UserController::class, 'add'])->name('user.add');
            Route::get('edit/{user}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('add', [UserController::class, 'store'])->name('user.store');
            Route::post('update/{user}', [UserController::class, 'update'])->name('user.update');
            Route::post('/', [UserController::class, 'status'])->name('user.status');

            Route::middleware(['global_admin'])->group(function(){
                Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
            });
        });


        Route::group(['prefix' => 'drivers'], function (){
            Route::get('/', [DriverController::class, 'index'])->name('drivers.index');
            Route::get('add', [DriverController::class, 'add'])->name('driver.add');
            Route::get('edit/{driver}', [DriverController::class, 'edit'])->name('driver.edit');
            Route::post('add', [DriverController::class, 'store'])->name('driver.store');
            Route::post('update/{driver}', [DriverController::class, 'update'])->name('driver.update');
            Route::post('/', [DriverController::class, 'status'])->name('driver.status');
        });

        Route::group(['prefix' => 'vehicles'], function (){
            Route::get('/', [VehicleController::class, 'index'])->name('vehicles.index');
            Route::get('add', [VehicleController::class, 'add'])->name('vehicle.add');
            Route::get('edit/{type}', [VehicleController::class, 'edit'])->name('vehicle.edit');
            Route::post('add', [VehicleController::class, 'store'])->name('vehicles.store');
            Route::post('update/{type}', [VehicleController::class, 'update'])->name('vehicle.update');
            Route::post('/', [VehicleController::class, 'status'])->name('vehicle.status');
        });

    });
});



Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);