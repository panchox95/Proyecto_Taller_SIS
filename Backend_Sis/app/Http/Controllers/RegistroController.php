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
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required',
                'password'=>'alpha_num',
            ]);
        if($validate->fails()){
            $data = $validate->errors();
            $code = 400;
        }
        else{
            $registro= new RegistroBL;
            $code=200;
            $data=$registro->registro($params);      
        }
        return response()->json($data,$code);
    }
}
