<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarwashProviderController;


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
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/riders', [App\Http\Controllers\CarwashProviderController::class, 'carwashproviderlist']);
    Route::get('/customers', function () { return view('admin.customers'); });


    //VEHICLES 
    Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index']);
    Route::post('/vehicles/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('store.vehicle');
    Route::get('/vehicles/show/{id}', [App\Http\Controllers\VehicleController::class, 'show']);
    Route::post('/vehicles/update/{id}', [App\Http\Controllers\VehicleController::class, 'update']);
    Route::post('/vehicles/destroy/{id}', [App\Http\Controllers\VehicleController::class, 'destroy']);
});

Route::group(['middleware' => 'App\Http\Middleware\CarwashProvider'], function () {

});

Route::group(['middleware' => 'App\Http\Middleware\Customer'], function () {

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Customer Registration
Route::get('/registers', [App\Http\Controllers\RegistrationController::class, 'registers']);
Route::POST('/registercustomer', [App\Http\Controllers\RegistrationController::class, 'registercustomer'])->name('rider_register');