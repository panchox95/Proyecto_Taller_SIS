<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BL\RegistroBL;
class RegistroController extends Controller
{

    public function registro(Request $request){
        //return $request;
        //Recoger El POST
        $json=$request->all('json',null);
        //$json2=$request->input('json',null);
        $params_array  = json_decode(json_encode( $json), true );

        $params=json_decode((json_encode($json)));
        //return $params_array;
        //Validamos
        $validate=false;
        $validate2= \Validator::make(
            $params_array,[
                'email'=>'email',
            ]
        );
        $validate3= \Validator::make(
            $params_array,[
                'last_name'=>'alpha',
            ]
        );
        $validate4= \Validator::make(
            $params_array,[
                'first_name'=>'alpha',
            ]
        );
        $validate5= \Validator::make(
            $params_array,[
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required',
                'password'=>'required',
            ]
        );
        $message='';
        if(strlen ( $params->password )<7 || strlen ( $params->password )>26){
            $validate=true;
            $message=$message.' La clave debe tener entre 8 y 25 caracteres';
        }
        if($validate2->fails()){
            $validate=true;
            $message=$message.' El campo correo debe ser un correo';
        }
        if($validate3->fails()){
            $validate=true;
            $message=$message.' El campo nombre debe tener solo letras';
        }
        if($validate4->fails()){
            $validate=true;
            $message=$message.' El campo apellido debe tener solo letras';
        }
        if($validate5->fails()){
            $validate=true;
            $message=$message.' Se deben llenar todos los campos';
        }
        if($validate){
            $data=array(
                'status'=>'ERROR',
                'code' => 400,
                'message' => $message);
            $code=400;
            return response()->json($data,$code);
        }
        else{
            $pass=$params->password;
            if(1 === preg_match('~[0-9]~', $pass)){
                if(1 === preg_match('~[a-z]~', $pass)){
                    if(1 === preg_match('~[A-Z]~', $pass)){
                        $registro= new RegistroBL;
                        $code=200;
                        $data=$registro->registro($params);
                    }
                    else{
                        $code=400;
                        $data=array(
                            'status'=>'ERROR',
                            'code' => 400,
                            'message' => 'La contraseña necesita por lo menos una letra mayuscula');
                    }

                }
                else{
                    $code=400;
                    $data=array(
                        'status'=>'ERROR',
                        'code' => 400,
                        'message' => 'La contraseña necesita por lo menos una letra');
                }

            }
            else{
                $code=400;
                $data=array(
                    'status'=>'ERROR',
                    'code' => 400,
                    'message' => 'La contraseña necesita por lo menos un numero');
            }

        }
        return response()->json($data,$code);
    }
}
