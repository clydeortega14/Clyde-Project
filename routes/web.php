<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function() {


	Route::get('/home', 'HomeController@index')->name('home');

	/* USER */
	Route::get('/users', 'UsersController@index')->name('users');
	Route::get('/user/create', 'UsersController@create')->name('user.create');
	Route::post('/user/store', 'UsersController@store')->name('user.store');
	Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.edit');
	Route::post('/user/update/{id}', 'UsersController@update')->name('user.update');

	/* CARS */
	Route::get('cars', 'CarsController@index')->name('cars');
	Route::get('cars/create', 'CarsController@create')->name('cars.create');
	Route::get('cars/edit/{id}', 'CarsController@edit')->name('cars.edit');
	Route::post('car/store', 'CarsController@store')->name('car.store');
	Route::put('car/update/{id}', 'CarsController@update')->name('car.update');
	Route::delete('car/destroy/{id}', 'CarsController@destroy')->name('car.destroy');

	/* CUSTOMERS */
	Route::resource('customers', 'CustomersController');

	/* DRIVERS */
	Route::resource('drivers', 'DriversController');

	/* TOUR PACKAGE */
	Route::resource('tour-packages', 'TourPackagesController');

	// AJAX
	Route::get('/users/data', 'UsersController@usersData');
	Route::post('/user/delete/{id}', 'UsersController@destroy')->name('user.destroy');
	Route::post('/user/update-status/{id}', 'UsersController@updateStatus')->name('user.update.status');

});
