<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BL\ProductoBL;
use App\Http\Requests;
class ProductosController extends Controller
{
    public function crearProducto(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validate = \Validator::make($params_array,[ // Validacion
            'nombre'=>'required',
            'marca'=>'required',
            'cantidad'=>'required',
            'precio'=>'required',
            'descripcion'=>'required',
            'categoria'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }
        else{ //Si la validacion es exitosa
            $producto = new ProductoBL;
            if($producto->existeProducto($params->nombre,$params->marca) == 0){
                $data = $producto->crearProducto($params);    
            }
            else{    
                $data=array(
                    'message'=>'El producto ya existe',
                    'code'=>404,
                    'status'=>'ERROR',
                );
            }        
        }
        return $data;
    }

    public function listaProductos(){
        $producto = new ProductoBL;
        $data=$producto->listaProductos();
        $code = 200;
        return response()->json($data,$code);
    }

    public function eliminarProducto($id){
        $producto = new ProductoBL;
        if($producto->existeProductoID($id) == 1){
            
            $data = $producto->eliminarProducto($id);  
        }
        else{    
            $data=array(
                'mensaje'=>'El producto no existe',
                'code'=>404,
                'status'=>'ERROR',
            );
        }    
        return $data;
    }

    public function modificarProducto($id,Request $request){
        $json=$request->all('json',null);
        $params_array  = json_decode(json_encode( $json), true );
        
        $params=json_decode((json_encode($json)));
        //return $params_array;
        //Validamos
        $validate= \Validator::make(
            $params_array,[
                'nombre'=>'required',
                'marca'=>'required',
                'cantidad'=>'required',
                'precio'=>'required',
                'descripcion'=>'required',
            ]);
        if($validate->fails()){
            $data = $validate->errors();
            $code = 400;
        }
        else{
            $producto = new ProductoBL;
            if($producto->existeProductoID($id) == 1){
                
                $code=200;
                $data=$producto->modificarProducto($params,$id);
            }
            else{    
                $data=array(
                    'mensaje'=>'El producto no existe',
                    'code'=>404,
                    'status'=>'ERROR',
                );
            }    
        }
        return response()->json($data,$code);
    }
    public function verProducto($id_producto){
        $producto=new ProductoBl;
        if($producto->existeProductoID($id_producto) == 1){
            $data=$producto->verProducto($id_producto);
            $code=200;
        }else{
            $data=array(
                'mensaje'=>'Producto Inexistente',
                'code'=>404,
                'status'=>'ERROR',
            );
        }
        return response()->json($data,$code);
    }
    public function busquedaNombre(Request $request){
        $json=$request->all('json',null);
        $params_array  = json_decode(json_encode( $json), true );
        
        $params=json_decode((json_encode($json)));
        //Validamos
        $validate= \Validator::make(
            $params_array,[
                'nombre'=>'required',
            ]);
        if($validate->fails()){
                $message='El campo de busqueda no puede estar vacio';
                $data=array(
                    'status'=>'ERROR',
                    'code' => 400,
                    'message' => $message);
                $code=400;
                return response()->json($data,$code);
            }
        $producto=new ProductoBl;
        $data = $producto->busquedaNombre($params);
        return response()->json($data,200);

        
    }
}
