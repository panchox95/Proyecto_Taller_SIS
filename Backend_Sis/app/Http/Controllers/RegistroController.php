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
        $validate= \Validator::make(
            $params_array,[
                'first_name'=>'required|alpha',
                'last_name'=>'required|alpha',
                'email'=>'required|email',
                'password'=>'required|digits_between:8,25',
            ]);
        if($validate->fails()){
            $data = $validate->errors();
            $code = 400;
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
