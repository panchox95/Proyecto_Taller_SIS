<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table ="servicio";

    public $timestamps = false;
    public function saveServicio($params){
        $this->nombre=$params->nombre;
        $this->precio=$params->precio;
        $this->descripcion=$params->descripcion;
        $this->estado='activo';
        $this->save();
    }
    public function existeServicio($nombre){
        return  Servicio::where(array('nombre'=>$nombre))->count();
    }
    public function existeServicioID($id){
        return  Servicio::where(array('id_servicio'=>$id))->count();
    }
    public function listadoServicios(){
        return  Servicio::select('*')
            ->where('servicio.estado','=','activo')
            ->paginate(5);
    }
    public function eliminarServicio($id){
        return Servicio::where('id_servicio',$id)
            ->update(["estado"=> 'borrado']);
    }
    public function modificarServicio($params,$id){
        return Servicio::where('id_servicio',$id)
            ->update(["nombre"=> $params->nombre,"precio"=> $params->precio,"descripcion"=> $params->descripcion]);
    }
    public function verServicio($id){
        return  Servicio::select('*')->where('id_servicio','=',$id)
                        ->where('servicio.estado','=','activo')
                        ->first();
    }
    public function busquedaNombre($nombre){
        return Servicio::select('*')->where('nombre','like', '%'.$nombre.'%')
                    ->where('servicio.estado','=','activo')
                    ->paginate(5);
    }
}