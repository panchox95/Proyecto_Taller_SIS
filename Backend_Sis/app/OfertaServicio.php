<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OfertaServicio extends Model
{
    protected $table ="ofertaservicio";

    public $timestamps = false;
    public function saveOferta($params,$id_servicio){
        $this->id_servicio=$id_servicio;
        $this->descripcion=$params->descripcion; 
        $this->descuento=$params->descuento/100;
        $this->estado='activo'; 
        $this->save();
    }
    public function borrarOferta($id_servicio){
        return OfertaServicio::where('id_servicio',$id_servicio)
                            ->update(["estado"=> 'borrado']);
    }
    public function modificarOferta($params,$id){
        return OfertaServicio::where('id_servicio',$id)
        ->update(["descripcion"=> $params->descripcion,"descuento"=>$params->descuento/100]);
    }
    public function listaOferta(){
        return $ofertas = OfertaServicio::select('*')
                            ->where('ofertaservicio.estado','=','activo')->get(); 
    }
    public function verOferta($id_servicio){
        $db = new DB;
        return  OfertaServicio::join('servicio', 'ofertaservicio.id_servicio', '=', 'servicio.id_servicio')
            ->select('servicio.nombre','servicio.precio',
                        $db::raw('servicio.precio*ofertaservicio.descuento AS preciodescuento'),
                        'ofertaservicio.descuento',
                        'servicio.descripcion')
            ->where('ofertaservicio.id_servicio','=',$id_servicio)
            ->where('servicio.estado','=','activo')
            ->where('ofertaservicio.estado','=','activo')
            ->get();
    }
    public function existeOfertaID($id){
        return $ofertas = OfertaServicio::select('*')
                            ->where('ofertaservicio.estado','=','activo')
                            ->where('ofertaservicio.id_servicio','=',$id)->count(); 
    }
}