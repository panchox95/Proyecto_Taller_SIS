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
Route::get('/api/listaproducto','ProductosController@listaProductos');
//Mostrar uhn producto en especifico por el id
//Route::get('/api/producto','ProductoController@show');
//Agregar producto
Route::post('/api/crearproducto','ProductosController@crearProducto')->middleware('Jwt')->middleware('admin');


//Eliminar un producto (Solo se cambia el estado de activo a borrado)

Route::put('/api/eliminarproducto/{id}','ProductosController@eliminarProducto')->middleware('Jwt')->middleware('admin');

//modificar un producto 
Route::put('/api/modificarproducto/{id}','ProductosController@modificarProducto')->middleware('Jwt')->middleware('admin');


//Ver
Route::get('/api/verproducto/{id}','ProductosController@verProducto');

//OFERTAS
//CREAR
Route::post('/api/crearoferta/{id}','OfertasController@crearOferta')->middleware('Jwt')->middleware('admin');
//BORRAR
Route::put('/api/borraroferta/{id}','OfertasController@borrarOferta')->middleware('Jwt')->middleware('admin');
//Modificar
Route::put('/api/modificaroferta/{id}','OfertasController@modificarOferta')->middleware('Jwt')->middleware('admin');
//Ver
Route::get('/api/veroferta/{id}','OfertasController@verOferta');
//Lista
Route::get('/api/listaoferta','OfertasController@listaOferta');

//PERFIL
//Ver
Route::get('/api/verperfil','PerfilController@verPerfil')->middleware('Jwt');
//Modificar
Route::put('/api/modificarperfil','PerfilController@modificarPerfil')->middleware('Jwt');

//Ver Foto
Route::get('/api/mostrarfoto','PerfilController@mostrarFoto')->middleware('Jwt');
//Subir Foto
Route::put('/api/subitfoto','PerfilController@subitFoto')->middleware('Jwt');


//CATEGORIAS

//Lista
Route::get('/api/listacategoria','CategoriaController@listaCategoria');
