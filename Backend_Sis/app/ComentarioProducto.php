<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioProducto extends Model
{
    protected $table ="comentarioproducto";

    public $timestamps = false;
    public function crearComentario($params,$id_producto,$id_user){
        $this->id_producto=$id_producto;
        $this->id_user=$params->id_user; 
        $this->comentario=$params->comentario; 
        $this->calificacion=$params->calificacion;
        $this->save();
    }
    public function listaComentario($id_producto){
        return $comentarios = ComentarioProducto::select('*')
                            ->where('comentarioproducto.id_producto','=',$id_producto)
                            ->get(); 
    }
}
