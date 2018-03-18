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

Route::get(
    '/', 'Auth\LoginController@showLoginForm'
);

Route::get('/cargos', function () {
        return view('malla.cargo.index');
        // return view('welcome');
    }
);


//Ruta usada por ajax para econtrar categorías según los proveedores
Route::get('ajaxCate/{codprov}', 'CategoriaController@ajaxCate');

//Ruta usada por ajax para econtrar articulos según los proveedores
Route::get('articulosp/{codprov}', 'IngresenController@selectArt');

Route::resource('ingresen', 'IngresenController');
Route::resource('agencia', 'AgenciaController');
Route::resource('articulo', 'ArticuloController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('categoria', 'CategoriaController');
Route::resource('nivel', 'NivelController');
Route::resource('persona', 'PersonaController');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/creaprov', 'HomeController@index')->name('home');
