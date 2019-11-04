<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
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

//Agregar producto
Route::post('/api/crearproducto','ProductosController@crearProducto')->middleware('Jwt')->middleware('admin');
//Eliminar un producto (Solo se cambia el estado de activo a borrado)
Route::put('/api/eliminarproducto/{id}','ProductosController@eliminarProducto')->middleware('Jwt')->middleware('admin');
//modificar un producto 
 Route::put('/api/modificarproducto/{id}','ProductosController@modificarProducto')->middleware('Jwt')->middleware('admin');
//Busqueda
Route::post('/api/busquedanombre','ProductosController@busquedaNombre');
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


//OFERTASSERVICIO
//CREAR OF
Route::post('/api/crearofertaservicio/{id}','OfertasServiciosController@crearOferta')->middleware('Jwt')->middleware('admin');
//BORRAR OF
Route::put('/api/borrarofertaservicio/{id}','OfertasServiciosController@borrarOferta')->middleware('Jwt')->middleware('admin');
//Modificar OF
Route::put('/api/modificarofertaservicio/{id}','OfertasServiciosController@modificarOferta')->middleware('Jwt')->middleware('admin');
//Ver OF
Route::get('/api/verofertaservicio/{id}','OfertasServiciosController@verOferta');
//Lista OF
Route::get('/api/listaofertaservicio','OfertasServiciosController@listaOferta');

//PERFIL
//Ver
Route::get('/api/verperfil','PerfilController@verPerfil')->middleware('Jwt');
//Modificar
Route::put('/api/modificarperfil','PerfilController@modificarPerfil')->middleware('Jwt');

//Ver Foto
Route::get('/api/mostrarfoto','PerfilController@mostrarFoto')->middleware('Jwt');
//Subir Foto
Route::put('/api/subirfoto','PerfilController@subirFoto')->middleware('Jwt');


//CATEGORIAS

//Lista
Route::get('/api/listacategoria','CategoriaController@listaCategoria');



//COMENTARIOS
//CREAR
Route::post('/api/crearcomentario/{id}','ComentarioController@crearComentario')->middleware('Jwt');

//Lista
Route::get('/api/listacomentario/{id}','ComentarioController@listaComentario');
//ListaServicio
Route::get('/api/listacomentarioservicio/{id}','ComentarioController@listaComentarioservicio');
//Puntaje
Route::get('/api/puntajeproducto/{id}','ComentarioController@puntajeProducto');
//Puntaje Servicio
Route::get('/api/puntajeservicio/{id}','ComentarioController@puntajeServicio');

//SERVICIOS
//Mostrar todos los servicios
Route::get('/api/listaservicio','ServiciosController@listaServicios');
//Agregar producto
Route::post('/api/crearservicio','ServiciosController@crearServicio')->middleware('Jwt')->middleware('admin');
//Eliminar un producto (Solo se cambia el estado de activo a borrado)
Route::put('/api/eliminarservicio/{id}','ServiciosController@eliminarServicio')->middleware('Jwt')->middleware('admin');
//modificar un producto 
 Route::put('/api/modificarservicio/{id}','ServiciosController@modificarServicio')->middleware('Jwt')->middleware('admin');
 //Ver
Route::get('/api/verservicio/{id}','ServiciosController@verServicio');