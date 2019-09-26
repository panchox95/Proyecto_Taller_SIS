<?php

namespace App\Http\Controllers;
use App\Http\BL\LoginBL;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function verPerfil(Request $request){
        $login = new LoginBL;
        $jwt = $request->header('Authorization',null);
        $decoded = $jwtAuth->decoded($jwt);
        $data = $login->verPerfil($decoded);
        return $data;
    }
    public function  modificarPerfil(Request $request){
        $login = new LoginBL;
        $jwt = $request->header('Authorization',null);
        
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $decoded = $jwtAuth->decoded($jwt);
        $data = $login->modificarPerfil($decoded,$params);
        return $data;
    }
}
