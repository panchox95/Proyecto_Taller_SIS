<?php

namespace App\Http\Controllers;
use App\Http\BL\PerfilBL;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;

class PerfilController extends Controller
{
    public function verPerfil(Request $request){
        $perfil = new PerfilBL;
        $jwtAuth = new JwtAuth();
        $jwt = $request->header('Authorization',null);
        $decoded = $jwtAuth->decode($jwt);
        $data = $perfil->verPerfil($decoded);
        return $data;
    }
    public function  modificarPerfil(Request $request){
        $perfil = new PerfilBL;
        $jwt = $request->header('Authorization',null);
        $jwtAuth = new JwtAuth();
        $input = $request->only(['user']);
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $params_array  = json_decode(json_encode( $json), true );
        $params_array_user  = json_decode(json_encode( $input), true );
        $paramsuser = json_decode((json_encode($input)));
       // $params_user  = json_decode(json_encode( $json->user), true );
        return $params->direccion;
        $validate=false;
        $validate4= \Validator::make(
            $params_array,[
                'telfono'=>'number',
            ]
        );
        $validate5= \Validator::make(
            $params_array,[
                'telefono'=>'required',
                'direccion'=>'required',
            ]
        );
        $validate6= \Validator::make(
            $params_array_user,[
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required',

            ]
        );
        
        $message='';
        if($validate4->fails()){
            $validate=true;
            $message=$message.' El campo telefono debe tener solo numeros';
        }
        if($validate5->fails() || $validate6->fails()){
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
            $decoded = $jwtAuth->decoded($jwt);
            $data = $perfil->modificarPerfil($decoded,$params);
            return $data;
        }
        
    }



    public function subirFoto(Request $request){
        if($request->hasFile('foto')){
            $file=$request->file('foto');
            $jwt = $request->header('Authorization',null);
            $name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/'.$name);
            $perfil = new PerfilBL;
            $decoded = $jwtAuth->decoded($jwt);
            $data=$perfil->subriFoto($decoded,$name);
            return $data;
        }
        else{
            return array('status' => 'ERROR','message'=>'No existe archivo');;
        }
    }
    public function mostrarFoto(Request $request){
        $jwt = $request->header('Authorization',null);
        $perfil = new PerfilBL;
        $decoded = $jwtAuth->decoded($jwt);
        $data=$perfil->mostrarFoto($decoded);
        return $data;
        
    }
}
