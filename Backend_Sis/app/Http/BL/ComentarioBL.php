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
        $lista=$comentario->listaComentario($id_producto);
        if($lista->isEmpty()){
            $data = array('status' => 'SUCCESS','message'=>'No Hay Ofertas');
        }
        else{
            $data = array('status' => 'SUCCESS','message'=>'lista de ofertas','ofertas'=>$lista);
        }
        return $data;
        return $data;
    }
    public function listaComentarioservicio($id){
        $comentario=new ComentarioServicio;
        $lista=$comentario->listaComentario($id);
        if(\is_object($lista)){
            $data = array('status' => 'SUCCESS','message'=>'lista de comentarios','comentarios'=>$lista);
        }
        else{
            $data = array('status' => 'SUCCESS','message'=>'No Hay Datos');
        }
        return $data;
    }
    public function puntajeproducto($id){
        $comentario=new ComentarioProducto;
        return array('status' => 'SUCCESS','message'=>'lista de comentarios','comentarios'=>$comentario->puntajeproducto($id));
    }
    public function puntajeServicio($id){
        $comentario=new ComentarioServicio;
        return array('status' => 'SUCCESS','message'=>'lista de comentarios','comentarios'=>$comentario->puntajeServicio($id));
    }
}