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
Route::post('/api/login','LoginController@login');
Route::post('/api/registro','RegistroController@registro');

//Productos
//Mostrar todos los productos
Route::get('/api/producto','ProductoController@index'); //RUTA JEFF
Route::get('/api/listaproducto','ProductosController@listaProductos'); //RUTA PANCHO
//Mostrar uhn producto en especifico por el id
//Route::get('/api/producto','ProductoController@show');
//Agregar producto
Route::post('/api/producto','ProductoController@store');//->middleware('Jwt'); //RUTA JEFF
Route::post('/api/crearproducto','ProductosController@crearProducto'); //RUTA PANCHO
