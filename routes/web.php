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

//Ruta para usuario con estado inactivo
Route::get('/inactivo', 'HomeController@inactivo')->name('inactivo'); 

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest')->name('inicio');

Auth::routes(['register' => false]);

Route::group(['middleware' => ['AdminMiddleware']], function () {
    Route::resource('/user', 'UserController');
    Route::get('/inicio', 'UserController@index')->name('admin-home')->middleware('estado'); ;
    Route::get('/usuarios/{slug}', 'UserController@show')->name('show-user');
    Route::get('/usuarios/{slug}/editar', 'UserController@edit')->name('edit-user');
    Route::get('/nuevo/usuario', 'UserController@create')->name('create-user');
});


Route::resource('/vehiculo', 'VehiculoController');
Route::resource('/marca', 'MarcaController');
Route::resource('/modelo', 'ModeloController');
Route::resource('/combustible', 'CombustibleController');
Route::resource('/tipovehiculo', 'TipovehiculoController');
Route::resource('/cliente', 'ClienteController');
Route::resource('/renta', 'RentaController');
Route::resource('/inspeccion', 'InspeccionController');

Route::group(['middleware' => ['EmpleadoMiddleware']], function () {
    
    Route::post('/vehiculos/get-modelos', 'VehiculoController@getModelos');

    Route::group(['prefix' => 'empleado'], function () {
        Route::get('/', 'TipovehiculoController@home')->name('empleado-home')->middleware('estado');

        //Export Excel
        Route::get('/reporte', 'RentaController@reporte')->name('reporte-renta');
        Route::get('/get-renta-excel', 'RentaController@exportExcel')->name('renta-excel');

        //Rutas de rentas
        Route::get('/rentas', 'RentaController@index')->name('index-renta');
        Route::get('/rentas/{slug}', 'RentaController@show')->name('show-renta');
        Route::get('/rentas/{slug}/editar', 'RentaController@edit')->name('edit-renta');
        Route::get('/nueva/renta', 'RentaController@create')->name('create-renta');

        //Rutas de Inspeccion
        //Route::get('/inspecciones', 'InspeccionController@index')->name('index-inspeccion');
        //Route::get('/inspeccion/{slug}', 'InspeccionController@show')->name('show-inspeccion');
        Route::get('/inspeccion/{slug}/editar', 'InspeccionController@edit')->name('edit-inspeccion');
        Route::get('/nueva/inspeccion/{slug}', 'InspeccionController@create')->name('create-inspeccion');

        //Rutas de vehiculos
        Route::get('/vehiculos', 'VehiculoController@index')->name('index-vehiculo');
        Route::get('/vehiculos/{slug}', 'VehiculoController@show')->name('show-vehiculo');
        Route::get('/vehiculos/{slug}/editar', 'VehiculoController@edit')->name('edit-vehiculo');
        Route::get('/nuevo/vehiculo', 'VehiculoController@create')->name('create-vehiculo');
        
        //Rutas de clientes
        Route::get('/clientes', 'ClienteController@index')->name('index-cliente');
        Route::get('/clientes/{slug}', 'ClienteController@show')->name('show-cliente');
        Route::get('/clientes/{slug}/editar', 'ClienteController@edit')->name('edit-cliente');
        Route::get('/nuevo/cliente', 'ClienteController@create')->name('create-cliente');

        //Rutas de tipo de vehiculo
        Route::get('/tipo-vehiculos', 'TipovehiculoController@create')->name('empleado-tipo-vehiculo');
        //Rutas de marcas
        Route::get('/marcas', 'MarcaController@create')->name('empleado-marca');
        //Rutas de modelo
        Route::get('/modelos', 'ModeloController@create')->name('empleado-modelo');
        //Rutas de combustible
        Route::get('/combustibles', 'CombustibleController@create')->name('empleado-combustible');
    });
});

