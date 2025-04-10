<?php

use App\Http\Controllers\AccommodationController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverTypeController;
use App\Http\Controllers\FleetClassController;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\FleetTypeController;
use App\Http\Controllers\HotelChainController;
use App\Http\Controllers\MountainController;
use App\Http\Controllers\MountainRouteController;
use App\Http\Controllers\NationalParkController;
use App\Http\Controllers\ParkFeeController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\TripTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'do_login'])->name('do.login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'do_register'])->name('do.register')->middleware('guest');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('fleet-types', [FleetTypeController::class, 'index'])->name('fleettypes.index');
    Route::post('fleet-types', [FleetTypeController::class, 'store'])->name('fleettypes.store');
    Route::put('fleet-types/{id}', [FleetTypeController::class, 'update'])->name('fleettypes.update');

    Route::get('fleet-classes', [FleetClassController::class, 'index'])->name('fleetclasses.index');
    Route::post('fleet-classes', [FleetClassController::class, 'store'])->name('fleetclasses.store');
    Route::put('fleet-classes/{id}', [FleetClassController::class, 'update'])->name('fleetclasses.update');

    Route::get('fleets', [FleetController::class, 'index'])->name('fleets.index');
    Route::post('fleets', [FleetController::class, 'store'])->name('fleets.store');
    Route::put('fleets/{id}', [FleetController::class, 'update'])->name('fleets.update');

    Route::get('driver-types', [DriverTypeController::class, 'index'])->name('drivertypes.index');
    Route::post('driver-types', [DriverTypeController::class, 'store'])->name('drivertypes.store');
    Route::put('driver-types/{id}', [DriverTypeController::class, 'update'])->name('drivertypes.update');

    
    Route::get('hotel-chains', [HotelChainController::class, 'index'])->name('hotelchains.index');
    Route::post('hotel-chains', [HotelChainController::class, 'store'])->name('hotelchains.store');
    Route::put('hotel-chains/{id}', [HotelChainController::class, 'update'])->name('hotelchains.update');
    
    Route::get('accommodations', [AccommodationController::class, 'index'])->name('accommodations.index');
    Route::post('accommodations', [AccommodationController::class, 'store'])->name('accommodations.store');
    Route::put('accommodations/{id}', [AccommodationController::class, 'update'])->name('accommodations.update');

    Route::get('drivers', [DriverController::class, 'index'])->name('drivers.index');
    Route::post('drivers', [DriverController::class, 'store'])->name('drivers.store');
    Route::put('drivers/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::get('/get-driver-fleet/{driverId}', [DriverController::class, 'Ajax_getDriverFleet'])->name('ajax.get_driver_fleet');


    Route::get('trip-types', [TripTypeController::class, 'index'])->name('triptypes.index');
    Route::post('trip-types', [TripTypeController::class, 'store'])->name('triptypes.store');
    Route::put('trip-types/{id}', [TripTypeController::class, 'update'])->name('triptypes.update');

    Route::get('service-items', [ServiceItemController::class, 'index'])->name('serviceitems.index');
    Route::post('service-items', [ServiceItemController::class, 'store'])->name('serviceitems.store');
    Route::put('service-items/{id}', [ServiceItemController::class, 'update'])->name('serviceitems.update');

    Route::get('trips', [TripController::class, 'index'])->name('trips.index');
    Route::post('trips', [TripController::class, 'store'])->name('trips.store');
    Route::put('trips/{id}', [TripController::class, 'update'])->name('trips.update');

    //Route For Booking Process
    Route::resource('bookings', BookingController::class);

    
    Route::get('carriers', [CarrierController::class, 'index'])->name('carriers.index');
    Route::post('carriers', [CarrierController::class, 'store'])->name('carriers.store');
    Route::put('carriers/{id}', [CarrierController::class, 'update'])->name('carriers.update');

    
    Route::get('service-providers', [ServiceProviderController::class, 'index'])->name('serviceproviders.index');
    Route::post('service-providers', [ServiceProviderController::class, 'store'])->name('serviceproviders.store');
    Route::put('service-providers/{id}', [ServiceProviderController::class, 'update'])->name('serviceproviders.update');
    Route::get('AjaxGetCities', [CityController::class, 'ajaxGetCitites'])->name('ajax.fetch.cities');

    Route::get('mountains', [MountainController::class, 'index'])->name('mountains.index');
    Route::post('mountains', [MountainController::class, 'store'])->name('mountains.store');
    Route::put('mountains/{id}', [MountainController::class, 'update'])->name('mountains.update');

    Route::get('mountain-routes', [MountainRouteController::class, 'index'])->name('mountainroutes.index');
    Route::post('mountain-routes', [MountainRouteController::class, 'store'])->name('mountainroutes.store');
    Route::put('mountain-routes/{id}', [MountainRouteController::class, 'update'])->name('mountainroutes.update');

    Route::get('channels', [ChannelController::class, 'index'])->name('channels.index');
    Route::post('channels', [ChannelController::class, 'store'])->name('channels.store');
    Route::put('channels/{id}', [ChannelController::class, 'update'])->name('channels.update');

    Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.index');
    Route::post('currencies', [CurrencyController::class, 'store'])->name('currencies.store');
    Route::put('currencies/{id}', [CurrencyController::class, 'update'])->name('currencies.update');

    Route::get('national-parks', [NationalParkController::class, 'index'])->name('nationalparks.index');
    Route::post('national-parks', [NationalParkController::class, 'store'])->name('nationalparks.store');
    Route::put('national-parks/{id}', [NationalParkController::class, 'update'])->name('nationalparks.update');

    Route::get('park-fees', [ParkFeeController::class, 'index'])->name('parkfees.index');
    Route::post('park-fees', [ParkFeeController::class, 'store'])->name('parkfees.store');
    Route::put('park-fees/{id}', [ParkFeeController::class, 'update'])->name('parkfees.update');
    Route::get('ajax-park-fees-data}', [ParkFeeController::class, 'Ajax_parkFeesData'])->name('parkFeesData');



});