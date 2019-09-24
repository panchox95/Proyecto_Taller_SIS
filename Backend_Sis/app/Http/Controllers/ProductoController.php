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

    public function show($id){
        $producto= Product::find($id)->load('user');
        return response()->json(array('producto'=> $producto,'status'=>'succes' ),200);
    }

    public function store(Request $request){

        $json=$request->all('json',null);
       $params_array  = json_decode(json_encode( $json), true );
       $params=json_decode((json_encode($json)));
       //Validamos

       $validate= \Validator::make($params_array,[
              'nombre'=>'required',
              'precio'=>'required',
              'estado'=>'required'
      ]);
      if($validate->fails()){
              return response()-> json($validate->errors(),400);
       }


       //Guardar
       $producto=new Producto();
       $producto->nombre= $params->nombre;
       $producto->marca= $params->marca;
       $producto->cantidad= $params->cantidad;
       $producto->precio= $params->precio;
       $producto->status= $params->status;
       $producto->save();

       $data=array(
        'producto'=>$producto,
        'status'=>'success',
        'code'=>200,
       );
       return response()->json($data,200);

   } // enclass

}
