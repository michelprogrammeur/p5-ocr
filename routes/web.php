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

Route::get('/', 'FrontController@index');

Auth::routes();
Route::get('/confirm/{id}/{token}', 'Auth\RegisterController@confirm');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'UserController@index')->name('dashboard');
});

