<?php

use App\Car;

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

Route::resource('car-dealership', 'DealershipController');

Route::get('/car-shop', function() {
    $cars = Car::with('car_model')->get();

    return view('car-dealership.index', compact('cars'));
});

Route::prefix('admin')->group(function() {
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@home')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::resource('admins', 'AdminController');
    Route::resource('roles', 'PageRoleController');
    Route::get('/car-dealerships', 'DealershipController@adminIndex');
    Route::post('/save-car', 'DealershipController@store');
    Route::resource('car-models', 'CarModelController');
});


