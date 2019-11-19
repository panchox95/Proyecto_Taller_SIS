<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table= 'user';
    public $timestamps = false;
    public function saveUsuario($params,$pwd){
        $this->first_name=$params->first_name;
        $this->last_name=$params->last_name;
        $this->email=$params->email;
        $this->password=$pwd;
        $this->rol='Usuario';
        $this->save();
    }
    public function existeUsuario($email,$pwd){
        return  User::where(array('email'=>$email,'password'=>$pwd))->count();
    }
    public function datosUsuario($email,$pwd){
        return User::where(array('email'=>$email,'password'=>$pwd))->first();
    }
    public function getIDUsuario($email){
        return User::select('id_user')->where(array('email'=>$email))->first();
    }
    public function existeCorreo($email){
        return  User::where(array('email'=>$email))->count();
    }
    public function errorIntentoUsuario($email,$intento){
        return  User::where(array('email'=>$email))->update(["intento"=> $intento]);
    }
    public function intentoUsuario($email){
        return  User::select('intento')->where(array('email'=>$email))->first();
    }
    public function checktime($email){
        return  User::select('ultimo_intento')->where(array('email'=>$email))->first();
    }
    public function resettime($email){
        User::where(array('email'=>$email))->update(["ultimo_intento"=>0]);
        User::where(array('email'=>$email))->update(["intento"=> 0]);
    }
    public function updatetime($email,$time){
        return  User::where(array('email'=>$email))->update(["ultimo_intento"=>$time]);
    }
    public function getrol($email){
        return  User::where('email', $email)->value('rol');
    }
    public function modificarPerfil($params,$id){
        return User::where('id_user',$id)
        ->update(["first_name"=> $params['first_name'],"last_name"=>$params['last_name'],"email"=>$params['email']]);
    }
}
