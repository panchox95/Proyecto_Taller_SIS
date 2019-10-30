<?php

namespace App\Http\Controllers;
use App\Http\BL\ComentarioBL;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

class ComentarioController extends Controller
{
    public function crearComentario(Request $request,$id_producto){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la 
        $comentario=new ComentarioBL;
        $jwt = $request->header('Authorization',null);
        $jwtAuth = new JwtAuth();
        $decoded = $jwtAuth->decode($jwt);
        $validate = \Validator::make($params_array,[ // Validacion
            'comentario'=>'required',
            'calificacion'=>'required',
            'tipo'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }
        $data=$comentario->crearComentario($params,$id_producto,$decoded);
        return response()->json($data,200);
    }
    public function listaComentario($id_producto){
        $comentario=new ComentarioBL;
        $data=$comentario->listaComentario($id_producto);
        return response()->json($data,200);
    }
    
    public function listaComentarioservicio($id_producto){
        $comentario=new ComentarioBL;
        $data=$comentario->listaComentarioservicio($id_producto);
        return response()->json($data,200);
    }
}
