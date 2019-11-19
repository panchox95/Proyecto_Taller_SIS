<?php

namespace App\Http\Controllers;
use App\Http\BL\OfertasBL;
use App\Http\BL\ProductoBL;
use Illuminate\Http\Request;

class OfertasController extends Controller
{
    public function crearOferta(Request $request,$id_producto){
        $oferta = new OfertasBL;
        $producto=new ProductoBl;
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $validate = \Validator::make($params_array,[ // Validacion
            'descripcion'=>'required',
            'descuento'=>'required'
        ]);
        if($params->descuento<1){
            $data=array(
                'message'=>'El valor debe ser mayor a 1',
                'code'=>400,
                'status'=>'ERROR',
            );
        }
        if(is_int($params->descuento)){
            if($producto->existeProductoID($id_producto) == 1){
                $data=$oferta->crearOferta($params,$id_producto);
            }else{
                $data=array(
                    'message'=>'Producto Inexistente',
                    'code'=>404,
                    'status'=>'ERROR',
                );
            }
        }
        else{
            $data=array(
                'message'=>'El valor debe ser entero',
                'code'=>400,
                'status'=>'ERROR',
            );
        }
        
        return $data;
    }
    public function borrarOferta($id_producto){
        $oferta = new OfertasBL;
        $producto = new ProductoBL;
        if($producto->existeProductoID($id_producto) == 1){
            $data=$oferta->borrarOferta($id_producto);
        }else{
            $data=array(
                'message'=>'Producto Inexistente',
                'code'=>404,
                'status'=>'ERROR',
            );
        }
        return $data;
    }
    public function modificarOferta($id,Request $request){
        $json=$request->all('json',null);
        $params_array  = json_decode(json_encode( $json), true );
        
        $params=json_decode((json_encode($json)));
        //return $params_array;
        //Validamos
        $validate= \Validator::make(
            $params_array,[
                'descripcion'=>'required',
                'descuento'=>'required'
            ]);
        if($validate->fails()){
            $data = $validate->errors();
            $code = 400;
        }
        
        else{
            $oferta = new OfertasBL;
            if($params->descuento<1){
                $code=400;
                $data=array(
                    'message'=>'El valor debe ser mayor a 1',
                    'code'=>400,
                    'status'=>'ERROR',
                );
            }
            if(is_int($params->descuento)){
                if($oferta->existeOfertaID($id) >= 1){
                    $code=200;
                    $data=$oferta->modificarOferta($params,$id);
                }
                else{    
                    $code=404;
                    $data=array(
                        'message'=>'El producto no existe',
                        'code'=>404,
                        'status'=>'ERROR',
                    );
                }  
            }  
            else{
                $code=400;
                    $data=array(
                        'message'=>'El valor debe ser entero',
                        'code'=>400,
                        'status'=>'ERROR',
                    );
                }
        }
        return response()->json($data,$code);
    }
    public function verOferta($id_producto){
        $oferta = new OfertasBL;
        $producto=new ProductoBl;
        if($producto->existeProductoID($id_producto) == 1){
            $data=$oferta->verOferta($id_producto);
            $code=200;
        }else{
            $code=404;
            $data=array(
                'message'=>'Producto Inexistente',
                'code'=>404,
                'status'=>'ERROR',
            );
        }
        return response()->json($data,$code);
    }
    public function listaOferta(){
        $oferta = new OfertasBL;
        $data=$oferta->listaOferta();
        $code = 200;
        return response()->json($data,$code);
    }
}
