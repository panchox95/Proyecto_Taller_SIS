<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
class ProductoController extends Controller
{
    //mostrar

    public function index(){
        $producto = Producto::all();
        return response()->json(array(
            'producto'=>$producto,
            'status'=>'succes'
        ),200);
    }
//No funciona bien porsia
    /*public function show($id){
       $producto= Product::find($id);
      return response()->json(array('producto'=> $producto,'status'=>'succes' ),200);
    }*/

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
       $producto->estado= $params->estado;
       $producto->save();

       $data=array(
        'producto'=>$producto,
        'status'=>'success',
        'code'=>200,
       );


       return response()->json($data,200);

   } // enclass

}
