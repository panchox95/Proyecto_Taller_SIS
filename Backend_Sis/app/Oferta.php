<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table ="oferta";

    public $timestamps = false;
    public function saveOferta($params,$id_producto){
        $this->id_producto=$id_producto;
        $this->descripcion=$params->descripcion; 
        $this->descuento=$params->descuento;
        $this->estado='activo'; 
        $this->save();
    }
    public function borrarOferta($id_producto){
        return Oferta::where('id_producto',$id_producto)
        ->update(["estado"=> 'borrado']);
    }
    public function modificarOferta($params,$id){
        return Oferta::where('id_producto',$id)
        ->update(["descripcion"=> $params->descripcion,"precio"=>$params->precio]);
    }
    public function listaOferta(){
        return $ofertas = Oferta::select('*')
                            ->where('oferta.estado','=','activo'); 
    }
    public function verOferta($id){
        return  Oferta::select('*')->where('id_producto','=',$id)->first();
    }
}
