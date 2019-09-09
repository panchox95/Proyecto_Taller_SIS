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
        $user = new Usuario();
        $first_name=$user->firstname($params->email);
        $last_name=$user->lastname($params->email);
        //$jwt = $jwtauth->signup($params->username,$pwd);
        //$paramsjwt = json_decode((json_encode($jwt)));
        //$token = $paramsjwt->token;
        //$identity = $paramsjwt->identity;
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Bienvenido '.$first_name.' '.$last_name,
        );
    }
    public function existeUsuario($email,$pwd){
        $user = new Usuario;
        return $user->existeUsuario($email,$pwd);
    }

}