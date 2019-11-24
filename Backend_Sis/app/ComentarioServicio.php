<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioServicio extends Model
{
    protected $table ="comentarioservicio";

    public $timestamps = false;
    public function crearComentario($params,$id_servicio,$id_user){
        $this->id_servicio=$id_servicio;
        $this->id_user=$id_user; 
        $this->comentario=$params->comentario; 
        $this->calificacion=$params->calificacion;
        $this->save();
    }
    public function listaComentario($id_servicio){
        return $comentarios = ComentarioServicio::join('user', 'comentarioservicio.id_user', '=', 'user.id_user')
                                                ->select('user.first_name','user.last_name','comentarioservicio.comentario','comentarioservicio.calificacion')
                                                ->where('comentarioservicio.id_servicio','=',$id_servicio)
                                                ->get(); 
    }
    public function puntajeServicio($id){
        return ComentarioServicio::join('user', 'comentarioservicio.id_user', '=', 'user.id_user')
                                ->select('comentarioservicio.calificacion')
                                ->where('comentarioservicio.id_servicio','=',$id)
                                ->avg('comentarioservicio.calificacion');
    }
}
