<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarwashProviderController;
use App\Http\Controllers\CustomerController;

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
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'App\Http\Middleware\Admin'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/customers', function () { return view('admin.customers.customers'); });

    //CARWASH PROVIDER
    Route::get('/riders', [App\Http\Controllers\CarwashProviderController::class, 'carwashproviderlist']);
    Route::get('/carwash/show/{id}', [App\Http\Controllers\CarwashProviderController::class, 'show']);
    Route::post('/carwash/approved/{id}', [App\Http\Controllers\CarwashProviderController::class, 'approved']);
    Route::post('/carwash/update/{id}', [App\Http\Controllers\CarwashProviderController::class, 'update']);


    //VEHICLES 
    Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
    Route::post('/vehicles/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('store.vehicle');
    Route::get('/vehicles/show/{id}', [App\Http\Controllers\VehicleController::class, 'show']);
    Route::post('/vehicles/update/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
    Route::post('/vehicles/destroy/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);
});

Route::group(['middleware' => 'App\Http\Middleware\CarwashProvider'], function () {
    Route::get('/carwashprovider', [App\Http\Controllers\CarwashProviderController::class, 'index'])->name('carwashprovider');
    Route::get('/wallet', function () { return view('rider.wallet.wallet'); });

});

Route::group(['middleware' => 'App\Http\Middleware\Customer'], function () {
    Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Customer Registration
Route::get('/registers', [App\Http\Controllers\RegistrationController::class, 'registers']);
Route::POST('/registercustomer', [App\Http\Controllers\RegistrationController::class, 'registercustomer'])->name('rider_register');