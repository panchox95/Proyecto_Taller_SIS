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
                    'mensaje'=>'El producto ya existe',
                    'code'=>404,
                    'status'=>'ERROR',
                );
            }        
        }
        return response()->json($data);
    }

    public function listaProductos(){
        $producto = new ProductoBL;
        $data=$producto->listaProductos();
        $code = 200;
        return response()->json($data,$code);
    }

    public function eliminar(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validate = \Validator::make($params_array,[ // Validacion
            
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }
        else{ //Si la validacion es exitosa
            $producto = new ProductoBL;
            if($producto->estadoProducto($params->estado) == 1){
                $data = $producto->crearProducto($params);    
            }
            else{    
                $data=array(
                    'mensaje'=>'El producto no existe',
                    'code'=>404,
                    'status'=>'ERROR',
                );
            }        
        }
        return response()->json($data);
    }

    public function modificar(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validate = \Validator::make($params_array,[ // Validacion
            
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }
    }

}
