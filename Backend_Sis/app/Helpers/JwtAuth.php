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
            return $jwtdecoded;
        }
        return array('status'=>'error','message'=>'Login a Fallado');

    }
    public function encode($token){
        $jwt = new JWT;
        $encode = $jwt::encode($token,$this->key,'HS256');
        return $encode;
    }
    public function decode($jwt){
        $jwts = new JWT;
        $decode = $jwts::decode($jwt,$this->key,array('HS256'));
        return $decode;
    }

    public function checkToken($jwt){
        $auth = false;
        try{
            $jwts = new JWT;
            $decoded = $jwts::decode($jwt,$this->key,array('HS256'));
            if(is_object($decoded) && isset($decoded->id_user)){
                //echo $decoded->id_user;
                $auth=true;
            }

        }
        catch(\UnexpectedValueException $e){
            //echo 'Unexpected Value Exception';
        }
        catch(\DomainException $e){
            //echo 'Domain Exception';
        }

        return $auth;
    }

    public function getTokenAdmi(){
        return  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjoxLCJmaXJzdF9uYW1lIjoiYWRtaW4iLCJsYXN0X25hbWUiOiJhZG1pbiIsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwiaWF0IjoxNTcyNjE4NDA3LCJleHAiOjE4ODc5Nzg0MDd9.VZrYb3nYPuctN6JYF2IICMdyFqPV64u4PGutzf3nhIE';
    }
    public function getTokenUser(){
        return  'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF91c2VyIjo1LCJmaXJzdF9uYW1lIjoidXN1YXJpbyIsImxhc3RfbmFtZSI6InVzdWFyaW9zbyIsImVtYWlsIjoidXN1YXJpb0B1c3VhcmlvLmNvbSIsImlhdCI6MTU3MzE4MjQzNSwiZXhwIjoxODg4NTQyNDM1fQ.TXli2OgVr8C3N04o9y2d-UjoYV9AFtBPl4zB4Yhz80k';
    }
}


?>
