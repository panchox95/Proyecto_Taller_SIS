<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfertaProducto extends Model
{
    protected $table ="ofertaproducto";

    public $timestamps = false;
    public function saveOferta($params,$id_producto){
        $this->id_producto=$id_producto;
        $this->descripcion=$params->descripcion; 
        $this->descuento=$params->descuento/100;
        $this->estado='activo'; 
        $this->save();
    }
    public function borrarOferta($id_producto){
        return OfertaProducto::where('id_producto',$id_producto)
        ->update(["estado"=> 'borrado']);
    }
    public function modificarOferta($params,$id){
        return OfertaProducto::where('id_producto',$id)
        ->update(["descripcion"=> $params->descripcion,"precio"=>$params->precio]);
    }
    public function listaOferta(){
        return $ofertas = OfertaProducto::select('*')
                            ->where('ofertaproducto.estado','=','activo')->get(); 
    }
    public function verOferta($id){
        return  OfertaProducto::select('*')->where('id_producto','=',$id)->first();
    }
}
