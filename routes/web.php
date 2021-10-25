<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarwashProviderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TopUpController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//RIDER Registration
Route::get('/application', [App\Http\Controllers\RegistrationController::class, 'registers']);
Route::POST('/riderapplication', [App\Http\Controllers\RegistrationController::class, 'riderapplication'])->name('rider_register');
//ADDRESS   
Route::get('/regionChange/{regCode}', [App\Http\Controllers\RegistrationController::class, 'forprovince']);
Route::get('/provinceChange/{provinceCode}', [App\Http\Controllers\RegistrationController::class, 'formunicipal']);
Route::get('/municipalityChange/{municipalityCode}', [App\Http\Controllers\RegistrationController::class, 'forbrgy']);

Auth::routes();
/*
|
|
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
|
|
*/

Route::group(['middleware' => 'App\Http\Middleware\Admin'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

    //CARWASH PROVIDER
    Route::get('/riders', [App\Http\Controllers\AdminController::class, 'carwashproviderlist']);
    Route::get('/carwash/show/{id}', [App\Http\Controllers\AdminController::class, 'show']);
    Route::post('/carwash/approved/{id}', [App\Http\Controllers\AdminController::class, 'approved']);
    Route::post('/carwash/uploadimage/{id}', [App\Http\Controllers\AdminController::class, 'uploadimage']);
    Route::post('/carwash/update/{id}', [App\Http\Controllers\AdminController::class, 'update']);
    Route::get('/customers', [App\Http\Controllers\AdminController::class, 'customerslist']);


    //VEHICLES 
    Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
    Route::post('/vehicles/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('store.vehicle');
    Route::get('/vehicles/show/{id}', [App\Http\Controllers\VehicleController::class, 'show']);
    Route::post('/vehicles/update/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
    Route::post('/vehicles/destroy/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);

    //TOP-UP
    Route::get('/topuprequest', [App\Http\Controllers\TopUpController::class, 'topuprequest']);
    Route::get('/topUp/show/{id}', [App\Http\Controllers\TopUpController::class, 'topUp_show']);
    Route::POST('/topUp/approve/{id}', [App\Http\Controllers\TopUpController::class, 'topUp_approve']);
    Route::get('/topUp/rejectshow/{id}', [App\Http\Controllers\TopUpController::class, 'topUp_rejectshow']);
    Route::POST('/topUp/reject/{id}', [App\Http\Controllers\TopUpController::class, 'topUp_reject']);

});
/*
|
|
|--------------------------------------------------------------------------
| CARWASH PROVIDER
|--------------------------------------------------------------------------
|
|
*/
Route::group(['middleware' => 'App\Http\Middleware\CarwashProvider'], function () {
    // DISPLAYS
    Route::get('/carwashprovider', [App\Http\Controllers\CarwashProviderController::class, 'index'])->name('carwashprovider');
    Route::get('/wallet', [App\Http\Controllers\CarwashProviderController::class, 'wallet']);
    Route::get('/bookings', function () { return view('rider.bookinghistory.bookinghistory'); });
    
    // ONCHANGE STATUS
    Route::post('/onchangeStatRider', [App\Http\Controllers\CarwashProviderController::class, 'onchangeStatRider'])->name('onchangeStatRider');

    Route::get('/carwashprovider', [App\Http\Controllers\CarwashProviderController::class, 'index'])->name('carwashprovider');
    
    // BOOKING
    Route::get('/getBooking', [App\Http\Controllers\CarwashProviderController::class, 'getBooking'])->name('getBooking');
    Route::post('/confirmBooking/{id}', [App\Http\Controllers\CarwashProviderController::class, 'confirmBooking']);
    Route::get('/booking_data/{id}', [App\Http\Controllers\CarwashProviderController::class, 'booking_data']);
    Route::POST('/doneBooking', [App\Http\Controllers\CarwashProviderController::class, 'doneBooking'])->name('doneBooking');

    //Request Top-up
    Route::post('/topupRequest', [App\Http\Controllers\CarwashProviderController::class, 'topupRequest'])->name('topupRequest');


});
/*
|
|
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
|
|
*/
Route::group(['middleware' => 'App\Http\Middleware\Customer'], function () {
    Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
    Route::POST('/ridersearch', [App\Http\Controllers\CustomerController::class, 'ridersearch']);
    Route::POST('/riderinfofetch', [App\Http\Controllers\CustomerController::class, 'riderinfofetch'])->name('riderinfofetch');
    Route::POST('/riderdistancefetch', [App\Http\Controllers\CustomerController::class, 'riderdistancefetch'])->name('riderdistancefetch');
    Route::POST('/saveBooking', [App\Http\Controllers\CustomerController::class, 'saveBooking'])->name('saveBooking');
    Route::get('/getBookingCustomer', [App\Http\Controllers\CustomerController::class, 'getBookingCustomer']);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
