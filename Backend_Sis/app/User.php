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
    public function idUsuario($username){
        return User::where('username', $username)->value('id_usuario');
    }
    public function existeUsuario($username,$pwd){
        return  User::where(array('username'=>$username,'password'=>$pwd))->where('usuario.tx_eliminacion','=',null)->count();
    }
}
