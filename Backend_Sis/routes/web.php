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
Route::get('/api/login','LoginController@login');
Route::post('/api/registro','RegistroController@registro');

//Productos
//Mostrar todos los productos
Route::get('/api/producto','ProductoController@index');
//Mostrar uhn producto en especifico por el id
//Route::get('/api/producto','ProductoController@show');
//Agregar producto
Route::post('/api/producto','ProductoController@store');//->middleware('Jwt');
