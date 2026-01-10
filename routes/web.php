<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverTypeController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\HotelChainController;
use App\Http\Controllers\LodgeController;
use App\Http\Controllers\MountainController;
use App\Http\Controllers\MountainRouteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\SystemModuleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('auth.login'))->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/get-driver-fleet/{driverId}', [DriverController::class, 'Ajax_getDriverFleet'])
        ->name('ajax.get_driver_fleet');

    Route::resource('activities', ActivityController::class);
    Route::resource('enquiries', EnquiryController::class);
    Route::resource('lodges', LodgeController::class);

    Route::get('hotel-chains', [HotelChainController::class, 'index'])->name('hotelchains.index');
    Route::get('hotel-chains/create', [HotelChainController::class, 'create'])->name('hotelchains.create');
    Route::post('hotel-chains', [HotelChainController::class, 'store'])->name('hotelchains.store');
    Route::get('hotel-chains/{hotelchain}', [HotelChainController::class, 'show'])->name('hotelchains.show');
    Route::get('hotel-chains/{hotelchain}/edit', [HotelChainController::class, 'edit'])->name('hotelchains.edit');
    Route::put('hotel-chains/{hotelchain}', [HotelChainController::class, 'update'])->name('hotelchains.update');
    Route::delete('hotel-chains/{hotelchain}', [HotelChainController::class, 'destroy'])->name('hotelchains.destroy');

    Route::get('service-items', [ServiceItemController::class, 'index'])->name('serviceitems.index');
    Route::post('service-items', [ServiceItemController::class, 'store'])->name('serviceitems.store');
    Route::put('service-items/{id}', [ServiceItemController::class, 'update'])->name('serviceitems.update');
    Route::delete('service-items/{id}', [ServiceItemController::class, 'destroy'])->name('serviceitems.destroy');

    Route::get('service-providers', [ServiceProviderController::class, 'index'])->name('serviceproviders.index');
    Route::post('service-providers', [ServiceProviderController::class, 'store'])->name('serviceproviders.store');
    Route::put('service-providers/{id}', [ServiceProviderController::class, 'update'])->name('serviceproviders.update');
    Route::delete('service-providers/{id}', [ServiceProviderController::class, 'destroy'])->name('serviceproviders.destroy');

    Route::get('carriers', [CarrierController::class, 'index'])->name('carriers.index');
    Route::post('carriers', [CarrierController::class, 'store'])->name('carriers.store');
    Route::put('carriers/{id}', [CarrierController::class, 'update'])->name('carriers.update');
    Route::delete('carriers/{id}', [CarrierController::class, 'destroy'])->name('carriers.destroy');

    Route::controller(ChannelController::class)->group(function () {
        Route::get('channels', 'index')->name('channels.index');
        Route::post('channels', 'store')->name('channels.store');
        Route::put('channels/{channel}', 'update')->name('channels.update');
        Route::delete('channels/{channel}', 'destroy')->name('channels.destroy');
    });

    Route::resource('accommodations', AccommodationController::class);


    Route::get('trip-types', [TripTypeController::class, 'index'])->name('triptypes.index');
    Route::post('trip-types', [TripTypeController::class, 'store'])->name('triptypes.store');
    Route::put('trip-types/{id}', [TripTypeController::class, 'update'])->name('triptypes.update');
    Route::delete('trip-types/{id}', [TripTypeController::class, 'destroy'])->name('triptypes.destroy');

    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::get('trips/create', [TripController::class, 'create'])->name('trips.create');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::put('trips/{id}', [TripController::class, 'update'])->name('trips.update');

    Route::get('mountains', [MountainController::class, 'index'])->name('mountains.index');
    Route::get('mountains/create', [MountainController::class, 'create'])->name('mountains.create');
    Route::post('mountains', [MountainController::class, 'store'])->name('mountains.store');
    Route::get('mountains/{mountain}', [MountainController::class, 'show'])->name('mountains.show');
    Route::get('mountains/{mountain}/edit', [MountainController::class, 'edit'])->name('mountains.edit');
    Route::put('mountains/{mountain}', [MountainController::class, 'update'])->name('mountains.update');
    Route::delete('mountains/{mountain}', [MountainController::class, 'destroy'])->name('mountains.destroy');

    Route::get('mountain-routes', [MountainRouteController::class, 'index'])->name('mountainroutes.index');
    Route::get('mountain-routes/create', [MountainRouteController::class, 'create'])->name('mountainroutes.create');
    Route::post('mountain-routes', [MountainRouteController::class, 'store'])->name('mountainroutes.store');
    Route::get('mountain-routes/{mountainroute}', [MountainRouteController::class, 'show'])->name('mountainroutes.show');
    Route::get('mountain-routes/{mountainroute}/edit', [MountainRouteController::class, 'edit'])->name('mountainroutes.edit');
    Route::put('mountain-routes/{mountainroute}', [MountainRouteController::class, 'update'])->name('mountainroutes.update');
    Route::delete('mountain-routes/{mountainroute}', [MountainRouteController::class, 'destroy'])->name('mountainroutes.destroy');

    Route::get('drivers/types', [DriverTypeController::class, 'index'])->name('drivertypes.index');
    Route::post('drivers/types', [DriverTypeController::class, 'store'])->name('drivertypes.store');
    Route::put('drivers/types/{id}', [DriverTypeController::class, 'update'])->name('drivertypes.update');

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::put('drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');

    Route::controller(CurrencyController::class)->group(function () {
        Route::get('currencies', 'index')->name('currencies.index');
        Route::post('currencies', 'store')->name('currencies.store');
        Route::put('currencies/{currency}', 'update')->name('currencies.update');
        Route::delete('currencies/{currency}', 'destroy')->name('currencies.destroy');
    });

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

    Route::controller(DriverController::class)->group(function () {
        Route::get('drivers', 'drivers')->name('drivers.index');
        Route::post('drivers', 'driverStore')->name('drivers.store');
        Route::put('drivers/{driver}', 'driverUpdate')->name('drivers.update');
        Route::delete('drivers/{driver}', 'driverDestroy')->name('drivers.destroy');
        Route::get('drivers/types', 'driverTypes')->name('drivertypes.index');
        Route::post('drivers/types', 'driverTypesStore')->name('drivertypes.store');
        Route::put('drivers/types/{type}', 'driverTypesUpdate')->name('drivertypes.update');
        Route::delete('drivers/types/{type}', 'driverTypesDestroy')->name('drivertypes.destroy');
    });

    Route::resource('agents', AgentController::class);
    Route::resource('users', UserController::class);
    Route::resource('bookings', BookingController::class);

    // Permission and Role Management
    Route::resource('permissions', PermissionController::class);
    Route::resource('roles', RoleController::class);

    // System Modules Management
    Route::resource('system-modules', SystemModuleController::class)->except(['create', 'edit']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
