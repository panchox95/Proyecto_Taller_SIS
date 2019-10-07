<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Helpers\JwtAuth;
class LoginBL 
{
    public function login($email,$pwd){
        $jwtauth = new JwtAuth();
        $user = new User();
        $first_name=$user->firstname($email);
        $last_name=$user->lastname($email);
        $jwt = $jwtauth->signup($email,$pwd);
        //$paramsjwt = json_decode((json_encode($jwt)));
        //$token = $paramsjwt->token;
        //$identity = $paramsjwt->identity;
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Bienvenido '.$first_name.' '.$last_name,'token'=>$jwt,
        );
    }
    public function existeUsuario($email,$pwd){
        $user = new User;
        return $user->existeUsuario($email,$pwd);
    }
    public function existeCorreo($email){
        $user = new User;
        return $user->existeCorreo($email);
    }
    public function errorIntentoUsuario($email){
        $user = new User;
        $intentos = $user->intentoUsuario($email)+1;
        $user->errorIntentoUsuario($email,$intento);
        return array(
            'mensaje'=>'Contraseña incorrecta',
            'code'=>404,
            'status'=>'ERROR');
    }
    public function intentoUsuario($email){
        $user = new User;
        return $user->intentoUsuario($email);
    }
}