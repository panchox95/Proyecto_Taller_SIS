<?php

namespace App;
use Illuminate\Support\Facades\DB;
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
        ->update(["descripcion"=> $params->descripcion,"descuento"=>$params->descuento/100]);
    }
    public function listaOferta(){
        return $ofertas = OfertaProducto::select('*')
                            ->where('ofertaproducto.estado','=','activo')->get(); 
    }
    public function verOferta($id_producto){
        $db = new DB;
        return  OfertaProducto::join('producto', 'ofertaproducto.id_producto', '=', 'producto.id_producto')
            ->select('producto.nombre',
                        'producto.marca',
                        'producto.cantidad',
                        'producto.precio',
                        $db::raw('producto.precio*ofertaproducto.descuento AS preciodescuento'),
                        'ofertaproducto.descuento',
                        'producto.descripcion')
            ->where('ofertaproducto.id_producto','=',$id_producto)
            ->where('producto.estado','=','activo')
            ->where('ofertaproducto.estado','=','activo')
            ->get();
    }
    public function existeOfertaID($id){
        return $ofertas = OfertaProducto::select('*')
                            ->where('ofertaproducto.estado','=','activo')
                            ->where('ofertaproducto.id_producto','=',$id)->count(); 
    }
}
