<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //mostrar

    public function index(){
        $productos = Producto::all();
        return response()->json(array(
            'productos'=>$productos,
            'status'=>'succes'
        ),200);
    }
}
