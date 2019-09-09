<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table= 'user';
    public $timestamps = false;
    public function saveUsuario($username,$pwd,$id_rol){
        $this ->username=$username;
        $this ->password=$pwd; 
        $this ->id_rol=$id_rol; 
        $this->save();
    }
    public function idUsuario($email){
        return User::where('email', $email)->value('id_usuario');
    }
    public function firstname($email){
        return User::where('email', $email)->value('first_name');
    }
    public function lastname($email){
        return User::where('email', $email)->value('last_name');
    }
    public function existeUsuario($email,$pwd){
        return  User::where(array('email'=>$email,'password'=>$pwd))->count();
    }
}
