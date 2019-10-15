<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table ="perfil";
    public $timestamps = false;
    public function savePerfil($id){
        $this->id_user=$id;
        $this->save();
    }
    public function modificarPerfil($params,$id){
        return Perfil::where('id_user',$id)
        ->update(["telefono"=> $params['telefono'],"direccion"=>$params['direccion'],"foto"=>$params['foto'],"tarjeta"=> $params['tarjeta'],"zipcode"=> $params['zipcode']]);
    }
    public function verPerfil($id){
       // return Perfil::where('id_perfil',$id)->first();
       return $users = Perfil::join('user', 'perfil.id_user', '=', 'user.id_user')
                            ->select('perfil.telefono', 'perfil.direccion', 'perfil.foto', 'user.first_name','user.last_name','user.email')
                            ->where('perfil.id_user', '=', $id)
                            ->first();
    }
    public function subirFoto($id,$name){
        return Perfil::where('id_user',$id)->update(["foto"=> $name]);
    }
    public function mostrarFoto($id){
        return Perfil::select('foto')->where('id_perfil',$id);
    }
}
