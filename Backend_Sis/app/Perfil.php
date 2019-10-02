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
        return Perfil::where('id_perfil',$id)
        ->update(["telefono"=> $params->telefono,"direccion"=>$params->direccion,"foto"=>$params->foto,"tarjetacredito"=> $params->tarjetacredito,"zipcode"=> $params->zipcode]);
    }
    public function verPerfil($id){
        return Perfil::where('id_perfil',$id)->first;
    }
    public function subirFoto($id,$name){
        return Perfil::where('id_perfil',$id)->update(["foto"=> $name]);
    }
    public function mostrarFoto($id){
        return Perfil::select('foto')->where('id_perfil',$id);
    }
}
