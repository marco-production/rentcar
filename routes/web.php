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
})->middleware('guest');

Auth::routes(['register' => false]);

Route::resource('/user', 'UserController');
Route::get('/inicio', 'UserController@index')->name('admin-home');
Route::get('/usuario/{slug}', 'UserController@show')->name('show-user');
Route::get('/usuario/{slug}/editar', 'UserController@edit')->name('edit-user');
Route::get('/nuevo/usuario', 'UserController@create')->name('create-user');

Route::resource('/tipovehiculo', 'TipovehiculoController');
Route::group(['prefix' => 'empleado'], function () {
    Route::get('/typevehiculenames', 'TipovehiculoController@getNames');
    ///////
    Route::get('/inicio', 'TipovehiculoController@home')->name('empleado-home');
    Route::get('/tipo-vehiculo', 'TipovehiculoController@create')->name('empleado-tipo-vehiculo');
});


