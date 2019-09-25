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
        return Producto::where('id_producto',$id)
        ->update(["telefono"=> $params->telefono,"direccion"=>$params->direccion,"foto"=>$params->foto,"tarjetacredito"=> $params->tarjetacredito,"zipcode"=> $params->zipcode]);
    }
    public function verPerfil($id){
        return Producto::where('id_producto',$id)->first;
    }
}
