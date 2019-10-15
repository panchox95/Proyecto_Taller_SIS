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
        
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $decoded = $jwtAuth->decoded($jwt);
        $data = $perfil->modificarPerfil($decoded,$params);
        return $data;
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
