<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BL\RegistroBL;
use Illuminate\Support\Facades\Validator;
class RegistroController extends Controller
{
    public function func($validates,$params_array,$params){
        $validate = false;
        $validate2 = $validates::make(
            $params_array,[
                'email'=>'email',
            ]
        );
        $validate3 = $validates::make(
            $params_array,[
                'last_name'=>'alpha',
            ]
        );
        $validate4 = $validates::make(
            $params_array,[
                'first_name'=>'alpha',
            ]
        );
        $validate5 = $validates::make(
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
        return $validate;
    }

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
        $validates = new Validator;
        $bool=$this->func($validates,$params_array,$params);
       
        if($bool){
            $data=array('status'=>'ERROR','code' => 400,'message' => $message);
            $code=400;
            return response()->json($data,$code);
        }
        $pass=$params->password;
        if(1 === preg_match('~[0-9]~', $pass)){
            if(1 === preg_match('~[a-z]~', $pass)){
                if(1 === preg_match('~[A-Z]~', $pass)){
                    $registro= new RegistroBL;
                    $code=200;
                    $data=$registro->registro($params);
                    return response()->json($data,$code);
                }
                //else{}
                $code=400;
                $data=array('status'=>'ERROR','code' => 400,'message' => 'La contraseña necesita por lo menos una letra mayuscula');
                return response()->json($data,$code);
            }
            $code=400;
            $data=array('status'=>'ERROR','code' => 400,'message' => 'La contraseña necesita por lo menos una letra');
            return response()->json($data,$code);
        }            
        $code=400;
        $data=array('status'=>'ERROR','code' => 400,'message' => 'La contraseña necesita por lo menos un numero');
        return response()->json($data,$code);
    }
}
