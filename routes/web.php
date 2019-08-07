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

Auth::routes();

Route::get('/', function () {

    return view('auth.login');
    
})->middleware('guest');

Route::get('/passport/clients', 'PassportClientsController@show');

Route::get('/backup', 'PassportClientsController@getBackup')->name('backup');

Route::middleware(['auth'])->group(function() {

	Route::get('/home', 'HomeController@index')->name('home');

	/*
		=========== ACCESS RIGHTS ROUTES ==============
	*/
	//USERS
	Route::get('/users', 'UsersController@index')->name('users');
	Route::get('/user/create', 'UsersController@create')->name('user.create');
	Route::post('/user/store', 'UsersController@store')->name('user.store');
	Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.edit');
	Route::post('/user/update/{id}', 'UsersController@update')->name('user.update');

	/* 
		=========== SET UP ROUTES ============
	 */

	//CARS
	Route::get('cars', 'CarsController@index')->name('cars');
	Route::get('cars/create', 'CarsController@create')->name('cars.create');
	Route::get('cars/edit/{id}', 'CarsController@edit')->name('cars.edit');
	Route::post('car/store', 'CarsController@store')->name('car.store');
	Route::put('car/update/{id}', 'CarsController@update')->name('car.update');
	Route::delete('car/destroy/{id}', 'CarsController@destroy')->name('car.destroy');
	//CUSTOMER
	Route::resource('customers', 'CustomersController');
	//DRIVERS
	Route::resource('drivers', 'DriversController');
	//TOUR PACKAGES
	Route::resource('tour-packages', 'TourPackagesController');
	//DESTINATIONS
	Route::resource('destinations', 'DestinationsController');

	/*
		================ TRANSACTIONS ROURS ==========================
	*/
	//RENT CARS
	Route::get('/rent-list', 'RentCarsController@index')->name('rent.list');
	Route::get('/book-reservation/{id}/edit', 'RentCarsController@edit')->name('rent-list.edit');
	Route::get('/book-reservation', 'RentCarsController@showReservationForm')->name('book.reservation');
	Route::post('/post-reservation', 'RentCarsController@postReservation')->name('post.reservation');
	Route::post('/update-reservation/{id}', 'RentCarsController@updateReservation')->name('update.reservation');

	//PENALTIES
	Route::resource('penalties', 'PenaltiesController');
	//PAYMENTS
	Route::resource('payments', 'PaymentsController');
	//SCHEDULE TOURS
	Route::resource('book-tours', 'BookToursController');

	/* 
		============ AJAX REQUESTS ROUTES =============
	*/
	//RENT CARS
	Route::get('/rent-list-data', 'RentCarsController@showRentData');
	//PAYMENTS DATA
	Route::get('/get-payments-data', 'PaymentsController@getPaymentsData');
	Route::get('/get-destination-rate/{cust_id}', 'PaymentsController@getDestinationRate');
	//DESTINATIONS DATA
	Route::get('/get-destinations', 'DestinationsController@getDestination');
	//CALENDAR EVENTS DATA
	Route::get('/event-list-data', 'RentCarsController@eventListData');

	Route::get('/users/data', 'UsersController@usersData');
	Route::post('/user/delete/{id}', 'UsersController@destroy')->name('user.destroy');
	Route::post('/user/update-status/{id}', 'UsersController@updateStatus')->name('user.update.status');

});
