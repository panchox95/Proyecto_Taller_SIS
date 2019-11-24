<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioProducto extends Model
{
    protected $table ="comentarioproducto";

    public $timestamps = false;
    public function crearComentario($params,$id_producto,$id_user){
        $this->id_producto=$id_producto;
        $this->id_user=$id_user; 
        $this->comentario=$params->comentario; 
        $this->calificacion=$params->calificacion;
        $this->save();
    }
    public function listaComentario($id_producto){
        return $comentarios = ComentarioProducto::join('user', 'comentarioproducto.id_user', '=', 'user.id_user')
                            ->select('user.first_name','user.last_name','comentarioproducto.comentario','comentarioproducto.calificacion')
                            ->where('comentarioproducto.id_producto','=',$id_producto)
                            ->get(); 
    }
    public function puntajeProducto($id){
        return ComentarioProducto::join('user', 'comentarioproducto.id_user', '=', 'user.id_user')
                                ->select('comentarioproducto.calificacion')
                                ->where('comentarioproducto.id_producto','=',$id)
                                ->avg('comentarioproducto.calificacion'); 
    }
}
