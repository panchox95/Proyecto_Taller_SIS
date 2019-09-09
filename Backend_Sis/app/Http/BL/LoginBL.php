<?php
namespace App\BL;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Persona;
use App\Empresa;
use App\Helpers\JwtAuth;
class LoginBL 
{
    public function login($params,$idrol,$pwd){
        //$jwtauth = new JwtAuth();
        $user = new User();
        $id=$user->idUsuario($params->username);
        $jwt = $jwtauth->signup($params->username,$pwd);
        $paramsjwt = json_decode((json_encode($jwt)));
        $token = $paramsjwt->token;
        $identity = $paramsjwt->identity;
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Bienvenido '.$nombre.' '.$apellido,
                    'token'=>$token,
                    'identity'=>$identity
        );
    }
    public function existeUsuario($username,$pwd){
        $user = new User;
        return $user->existeUsuario($username,$pwd);
    }

}