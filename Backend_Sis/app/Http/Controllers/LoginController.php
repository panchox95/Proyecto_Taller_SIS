<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BL\LoginBL;
use App\Http\Requests;
use App\Helpers\JwtAuth;
class LoginController extends Controller
{
    public function login(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validate = \Validator::make($params_array,[ // Validacion
            'email'=>'required',
            'password'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }
        else{ //Si la validacion es exitosa
            $pwd=hash('sha256',$params->password);
            //$pwd = $params->password;
            $login = new LoginBL;
            if($login->intentoUsuario($params->email)==3){
                $data=array(
                    'mensaje'=>'Numero de intentos superado',
                    'code'=>410,
                    'status'=>'ERROR',
                );
            }else{
                if($login->existeCorreo($params->email)==1 && $login->existeUsuario($params->email,$pwd) == 0){
                    $data=$login->errorIntentoUsuario($params->email);
                }else{
                    if($login->existeUsuario($params->email,$pwd) == 1){
                        $data = $login->login($params->email,$pwd);        
                    }
                    else{    
                        $data=array(
                            'mensaje'=>'Usuario o password erroneo',
                            'code'=>404,
                            'status'=>'ERROR',
                        );
                    }        
                }
            }
        }
            
        return response()->json($data);
    }
}
