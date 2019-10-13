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
        $user->updatetime($email,time());
        //$paramsjwt = json_decode((json_encode($jwt)));
        //$token = $paramsjwt->token;
        //$identity = $paramsjwt->identity;
        $rol=$user->getrol($email);
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Bienvenido '.$first_name.' '.$last_name,'token'=>$jwt,'rol'=>$rol
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
        $intentos = $user->intentoUsuario($email);
        $user->errorIntentoUsuario($email,$intentos->intento+1);
        $user->updatetime($email,time());
        return array(
            'mensaje'=>'Contraseña incorrecta',
            'code'=>404,
            'status'=>'ERROR');
    }
    public function intentoUsuario($email){
        $user = new User;
        $data = $user->intentoUsuario($email);
        return $data->intento;
    }
    public function checktime($email){
        $user = new User;
        $data = $user->checktime($email);
        return $data->ultimo_intento;
    }
    public function resettime($email){
        $user = new User;
        return $user->resettime($email);
    }
}