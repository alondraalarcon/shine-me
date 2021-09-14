<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rider Registration
Route::get('/registration', [App\Http\Controllers\RegistrationController::class, 'registration']);
Route::POST('/registerrider', [App\Http\Controllers\RegistrationController::class, 'riderregister'])->name('rider_register');
//Customer Registration
Route::get('/registers', [App\Http\Controllers\RegistrationController::class, 'registers']);
Route::POST('/registercustomer', [App\Http\Controllers\RegistrationController::class, 'registercustomer'])->name('customer_register');

// ADMIN VIEWS
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
