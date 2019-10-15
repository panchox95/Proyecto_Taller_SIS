<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\User;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key='TS@vjjfrmlsdmbu#19';
    }

    public function signup($email,$password,$getToken=null){
        $usuario = new User;
        $user=$usuario->datosUsuario($email,$password);
        if(\is_object($user)){
            $token = array(
                'id_user'=>$user->id_user,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'iat'=>time(),
                'exp'=>time()+(60*60),
            );
            $jwt=$this->encode($token);
            $jwtdecoded=$this->decode($jwt);
            if(is_null($getToken)){
                return $jwt;
            }
            else{
                return $jwtdecoded;
            }
        }
        else{
            return array('status'=>'error','message'=>'Login a Fallado');
        }

    }
    public function encode($token){
        return JWT::encode($token,$this->key,'HS256');
    }
    public function decode($jwt){
        return JWT::decode($jwt,$this->key,array('HS256')); 
    }

    public function checkToken($jwt,$getIdentity=false){
        $auth = false;
        try{
            $decoded=JWT::decode($jwt,$this->key,array('HS256'));
            
            
        }
        catch(\UnexpectedValueException $e){
            echo 'Unexpected Value Exception';
        }
        catch(\DomainException $e){
            echo 'Domain Exception';
        }
        if(is_object($decoded) && isset($decoded->id_user)){
            //echo $decoded->id_user;
            $auth=true;
        }
        return $auth;
    }
}


?>