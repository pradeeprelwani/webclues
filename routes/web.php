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
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/cars', 'CarController@index')->name('car.index');
    Route::get('/car/create', 'CarController@create')->name('car.create');
    Route::post('/car/create', 'CarController@store')->name('car.store');
    Route::get('/car/edit/{id}', 'CarController@edit')->name('car.edit');
    Route::post('/car/update/{id}', 'CarController@update')->name('car.update');
});
