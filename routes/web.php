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


Route::group(['middleware' => 'App\Http\Middleware\Admin'], function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/riderlist', function () {
        return view('admin.riderlist');
    });

});

Route::group(['middleware' => 'App\Http\Middleware\CarwashProvider'], function () {

});

Route::group(['middleware' => 'App\Http\Middleware\Customer'], function () {

});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Customer Registration
Route::get('/registers', [App\Http\Controllers\RegistrationController::class, 'registers']);
Route::POST('/registercustomer', [App\Http\Controllers\RegistrationController::class, 'registercustomer'])->name('customer_register');