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
            $comentarios->crearComentario($params,$id_producto,$id_user);
            return array('status' => 'SUCCESS','message'=>'Comentario Creado');
        }
        if($params->tipo=='producto'){
            $comentariop->crearComentario($params,$id_producto,$id_user);
            return array('status' => 'SUCCESS','message'=>'Comentario Creado');
        }
        return array('status' => 'ERROR','message'=>'tipo erroneo');
        
        
    }
    public function listaComentario($id_producto){
        $comentario=new ComentarioProducto;
        $lista=$comentario->listaComentario($id_producto);
        if($lista->isEmpty()){
            return array('status' => 'SUCCESS','message'=>'No Hay Ofertas');
        }
        return array('status' => 'SUCCESS','message'=>'lista de ofertas','ofertas'=>$lista);
    }
    public function listaComentarioservicio($id){
        $comentario=new ComentarioServicio;
        $lista=$comentario->listaComentario($id);
        if(\is_object($lista)){
            return array('status' => 'SUCCESS','message'=>'lista de comentarios','comentarios'=>$lista);
        }
            return array('status' => 'SUCCESS','message'=>'No Hay Datos');
        
    }
    public function puntajeproducto($id){
        $comentario=new ComentarioProducto;
        return array('status' => 'SUCCESS','message'=>'puntaje de producto','puntaje'=>$comentario->puntajeproducto($id));
    }
    public function puntajeServicio($id){
        $comentario=new ComentarioServicio;
        return array('status' => 'SUCCESS','message'=>'puntaje de servicio','puntaje'=>$comentario->puntajeServicio($id));
    }
}