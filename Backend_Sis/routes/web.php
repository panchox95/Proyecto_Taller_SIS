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

Route::group(['middleware'=> 'Jwt'], function () {
    //PERFIL
    //Ver
    Route::get('/api/verperfil','PerfilController@verPerfil');
    //Modificar
    Route::put('/api/modificarperfil','PerfilController@modificarPerfil');
    //Ver Foto
    Route::get('/api/mostrarfoto','PerfilController@mostrarFoto');
    //Subir Foto
    Route::put('/api/subirfoto','PerfilController@subirFoto');
    //Ordenes
    Route::get('/api/profile', [
        'uses'=> 'PerfilController@getProfile'
    ]);

    //COMENTARIOS
    //Agregar
    Route::post('/api/crearcomentario/{id}','ComentarioController@crearComentario');

    Route::group(['middleware'=> 'admin'], function () {
        //PRODUCTOS
        //Agregar
        Route::post('/api/crearproducto','ProductosController@crearProducto');
        //Eliminar (Solo se cambia el estado de activo a borrado)
        Route::put('/api/eliminarproducto/{id}','ProductosController@eliminarProducto');
        //modificar
        Route::put('/api/modificarproducto/{id}','ProductosController@modificarProducto');

        //OFERTAS
        //Agregar
        Route::post('/api/crearoferta/{id}','OfertasController@crearOferta');
        //Borrar
        Route::put('/api/borraroferta/{id}','OfertasController@borrarOferta');
        //Modificar
        Route::put('/api/modificaroferta/{id}','OfertasController@modificarOferta');

        //OFERTASSERVICIO
        //Agregar
        Route::post('/api/crearofertaservicio/{id}','OfertasServiciosController@crearOferta');
        //Borrar
        Route::put('/api/borrarofertaservicio/{id}','OfertasServiciosController@borrarOferta');
        //Modificar
        Route::put('/api/modificarofertaservicio/{id}','OfertasServiciosController@modificarOferta');

        //SERVICIOS
        //Agregar
        Route::post('/api/crearservicio','ServiciosController@crearServicio');
        //Eliminar
        Route::put('/api/eliminarservicio/{id}','ServiciosController@eliminarServicio');
        //Modificar
        Route::put('/api/modificarservicio/{id}','ServiciosController@modificarServicio');

    });
});

//PRODUCTOS
//Busqueda
Route::post('/api/busquedanombre','ProductosController@busquedaNombre');
//Ver
Route::get('/api/verproducto/{id}','ProductosController@verProducto');
//Precios
Route::post('/api/busquedaprecio','ProductosController@busquedaPrecio');

//OFERTAS
//Ver
Route::get('/api/veroferta/{id}','OfertasController@verOferta');
//Lista
Route::get('/api/listaoferta','OfertasController@listaOferta');

//OFERTASSERVICIO
//Ver OF
Route::get('/api/verofertaservicio/{id}','OfertasServiciosController@verOferta');
//Lista OF
Route::get('/api/listaofertaservicio','OfertasServiciosController@listaOferta');

//CATEGORIAS
//Lista
Route::get('/api/listacategoria','CategoriaController@listaCategoria');


//COMENTARIOS

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
 //Ver
Route::get('/api/verservicio/{id}','ServiciosController@verServicio');



//vista de check out
Route::get('/api/checkout', [
    'uses'=> 'ProductController@getCheckout',
    'as'=> 'checkout',
    'middleware'=>'Jwt'
]);

//comprar
Route::post('/api/checkout', [
    'uses'=> 'ProductController@postCheckout',
    'as'=> 'checkout',
    'middleware'=>'Jwt'
]);


    //CARRITO
    //anadir
    Route::get('/api/add-to-cart/{id_producto}', [
        'uses'=> 'ProductController@getAddToCart',
        'as'=> 'product.addToCart'
    ]);
    //reducir
    Route::get('/api/reduce/{id_producto}', [
        'uses'=> 'ProductController@getReduceByOne',
        'as'=> 'product.reduceByOne'
    ]);
    //eliminar
    Route::get('/api/remove/{id_producto}', [
        'uses'=> 'ProductController@getRemoveItem',
        'as'=> 'product.remove'
    ]);
    //vista
    Route::get('/api/shopping-cart', [
        'uses'=> 'ProductController@getCart',
        'as'=> 'product.shoppingCart'
    ]);

