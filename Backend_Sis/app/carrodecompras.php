<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carrodecompras extends Model
{
    protected $fillable=['id_user','id_mercaderia','nombre','canrtidad','descripcion','precio'];

    public function carritoProductos(){
//        $this->id_mercaderia=$params->id_producto;
//        $this->nombre=$params->nombre;
//        $this->descripcion=$params->descripcion;
//        $this->precio=$params->precio;
//        $this->save();
    }
}



