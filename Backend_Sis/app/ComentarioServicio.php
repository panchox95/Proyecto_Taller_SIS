<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioServicio extends Model
{
    protected $table ="comentariooferta";

    public $timestamps = false;
    public function crearComentario($params,$id_servicio,$id_user){
        $this->id_servicio=$id_servicio;
        $this->id_user=$params->id_user; 
        $this->comentario=$params->comentario; 
        $this->calificacion=$params->calificacion;
        $this->save();
    }
    public function listaComentario($id_servicio){
        return $comentarios = ComentarioServicio::join('user', 'comentariooferta.id_user', '=', 'user.id_user')
                                                ->select('user.first_name','user.last_name','comentariooferta.comentario','comentariooferta.calificacion')
                                                ->where('comentariooferta.id_servicio','=',$id_servicio)
                                                ->get(); 
    }
}
