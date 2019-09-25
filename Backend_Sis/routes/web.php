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

//PRODUCTOS
//Mostrar todos los productos
Route::get('/api/producto','ProductoController@index'); //RUTA JEFF
//esta paginado revisar como se devuelve la paginacion para mostrar los datos, solo se muestral los objetos con estado activo
Route::get('/api/listaproducto','ProductosController@listaProductos'); //RUTA PANCHO
//Mostrar uhn producto en especifico por el id
//Route::get('/api/producto','ProductoController@show');
//Agregar producto
Route::post('/api/producto','ProductoController@store');//->middleware('Jwt'); //RUTA JEFF
Route::post('/api/crearproducto','ProductosController@crearProducto'); //RUTA PANCHO

//Eliminar un producto (Solo se cambia el estado de activo a borrado)

Route::put('/api/eliminarproducto/{id}','ProductosController@eliminarProducto');

//modificar un producto 
Route::put('/api/modificarproducto/{id}','ProductosController@modificarProducto');
//Ver
Route::get('/api/verproducto/{id}','ProductosController@verProducto');

//OFERTAS
//CREAR
Route::post('/api/crearoferta/{id}','OfertasController@crearOferta');
//BORRAR
Route::put('/api/borraroferta/{id}','OfertasController@borrarOferta');
//Modificar
Route::put('/api/modificaroferta/{id}','OfertasController@modificarOferta');
//Ver
Route::get('/api/veroferta/{id}','OfertasController@verOferta');
//Lista
Route::get('/api/listaoferta','OfertasController@listaOferta');

//PERFIL
//Ver
Route::post('/api/verperfil','PerfilController@verPerfil')->middleware('Jwt');
//Modificar
Route::post('/api/modificarperfil','PerfilController@modificarPerfil')->middleware('Jwt');
