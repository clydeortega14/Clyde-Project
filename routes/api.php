<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {

	Route::get('/user', function(Request $request){

    	return $request->user();
	});

	//TODOS
	Route::get('/todos', 'API\TodoController@index');

	Route::post('/todo', 'API\TodoController@store');

	Route::get('/todo/{id}', 'API\TodoController@show');

	Route::put('/todo/update/{id}', 'API\TodoController@update');

	Route::delete('/todo/delete/{id}', 'API\TodoController@destroy');

});

Route::post('/login', 'ClientLoginController@login');

Route::get('/users', 'API\UserApiController@index');

Route::post('/users/store', 'API\UserApiController@store');

Route::get('/user/{id}', 'API\UserApiController@show');

Route::put('/user/update/{id}', 'API\UserApiController@update');

Route::delete('/user/delete/{id}', 'API\UserApiController@destroy');
