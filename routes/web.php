<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('auth.login'))->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::controller(FleetController::class)->group(function () {
        Route::get('fleets', 'fleets')->name('fleets.index');
        Route::post('fleets', 'fleetStore')->name('fleets.store');
        Route::put('fleets/{fleet}', 'fleetUpdate')->name('fleets.update');
        Route::delete('fleets/{fleet}', 'fleetDestroy')->name('fleets.destroy');
        Route::get('fleets/classes', 'fleetClasses')->name('fleetclasses.index');
        Route::post('fleets/classes', 'fleetClassesStore')->name('fleetclasses.store');
        Route::put('fleets/classes/{classes}', 'fleetClassesUpdate')->name('fleetclasses.update');
        Route::delete('fleets/classes/{classes}', 'fleetClassesDestroy')->name('fleetclasses.destroy');
        Route::get('fleets/types', 'fleetTypes')->name('fleettypes.index');
        Route::post('fleets/types', 'fleetTypesStore')->name('fleettypes.store');
        Route::put('fleets/types/{type}', 'fleetTypesUpdate')->name('fleettypes.update');
        Route::delete('fleets/types/{type}', 'fleetTypesDestroy')->name('fleettypes.destroy');
    });


    Route::resource('users', UserController::class);

    Route::get('/roles', [AccessController::class, 'roles'])->name('roles.index');

    Route::get('/permissions', [AccessController::class, 'permissions'])->name('permissions.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
