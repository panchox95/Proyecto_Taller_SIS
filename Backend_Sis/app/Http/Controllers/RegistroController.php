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
        $validate1= \Validator::make(
            $params_array,[
                'password'=>'digits_between:8,25',
            ]
        );
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
        if($validate1->fails()){
            $validate=true;
            
            $message=$message.' La contraseña debe tener entre 8 y 25 caracteres';
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
            if(str_contains($pass, '1') || str_contains($pass, '2') || str_contains($pass, '3') || str_contains($pass, '4') || str_contains($pass, '5') || str_contains($pass, '6') || str_contains($pass, '7') || str_contains($pass, '8') || str_contains($pass, '9') || str_contains($pass, '0') ){
                $registro= new RegistroBL;
                $code=200;
                $data=$registro->registro($params);      
            }
            else{
                $data='La contraseña no tiene numeros';
                $code=400;
            }
            
        }
        return response()->json($data,$code);
    }
}
