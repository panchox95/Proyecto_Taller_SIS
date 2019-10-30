<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\ComentarioServicio;
use App\ComentarioProducto;
use App\Helpers\JwtAuth;
class ComentarioBL 
{
    public function crearComentario($params,$id_producto,$decoded){
        $comentarios=new ComentarioServicio;
        $comentariop=new ComentarioProducto;
        $id_user = $decoded->id_user;
        if($params->tipo=='servicio'){
            $data=$comentarios->crearComentario($params,$id_producto,$id_user);
        }else{
            if($params->tipo=='producto'){
                $comentariop->crearComentario($params,$id_producto,$id_user);
            }
            else{
                return array('status' => 'ERROR','message'=>'tipo erroneo');
            }
        }
        return array('status' => 'SUCCESS','message'=>'Comentario Creado');
    }
    public function listaComentario($id_producto){
        $comentario=new ComentarioProducto;
        $data=$comentario->listaComentario($id_producto);
        return $data;
    }
    public function listaComentarioservicio($id_producto){
        $comentario=new ComentarioServicio;
        $data=$comentario->listaComentario($id_producto);
        return $data;
    }
}