<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| este cambio se hizo en otro ordenador
*/

Route::get(
    '/', 'Auth\LoginController@showLoginForm'
);

Route::get('/cargos', function () {
        return view('malla.cargo.index');
        // return view('welcome');
    }
);
//Ruta usada por ajax para devolver las localidades de una red y una zona
Route::get('AjaxNegocios/{cliente}', 'NegocioController@traeNegocios');
//Ruta usada por ajax para devolver las localidades de una red y una zona
Route::get('AjaxTraeLocalidades/{red}/{zona}', 'LocalidadController@traeLocalidades');
//Ruta usada por ajax para validar si el código de la localidad existe
Route::get('AjaxTraeZona/{red}', 'LocalidadController@traeZonas');
//Ruta usada por ajax para validar si el código de la localidad existe
Route::get('AjaxLocalidad/{red}/{zona}/{loca}', 'LocalidadController@validaEx');
//Ruta usada por ajax para validar si el código de la zona existe
Route::get('AjaxZona/{red}/{zona}', 'ZonaController@validaEx');
//Ruta usada por ajax para econtrar conceptos según rl tipo de ajuste
Route::get('selconcepto/{item}', 'AjustenController@selconcepto');
//Ruta usada por ajax para econtrar categorías según los proveedores
Route::get('ajaxCate/{codprov}', 'CategoriaController@ajaxCate');
//Ruta usada por ajax para econtrar articulos según los proveedores
Route::get('articulosp/{codprov}', 'IngresenController@selectArt');
//Ruta usada por ajax para econtrar articulos según los proveedores en el Ingreso
Route::get('articulosIngreso/{codprov}', 'IngresenController@articulosIngreso');

Route::get('crearnegoc/{cliente}', 'NegocioController@crearneg');

Route::resource('negocio', 'NegocioController');
Route::resource('localidad', 'LocalidadController');
Route::resource('zona', 'ZonaController');
Route::resource('red', 'RedController');
Route::resource('cliente', 'ClienteController');
Route::resource('ajusten', 'AjustenController');
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
