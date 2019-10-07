<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Oferta;
use App\Helpers\JwtAuth;
class OfertasBL 
{
    public function crearOferta($params,$id_producto){
        $oferta = new Oferta;
        $oferta->saveOferta($params,$id_producto);
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Creado '.$params->nombre.' '.$params->marca,
        );
    }
    public function borrarOferta($id_producto){
        $oferta = new Oferta;
        $oferta->eliminarOferta($id_producto);
        return array('status' => 'SUCCESS','mensaje'=>'Producto Eliminado');
    }
    public function modificarOferta($params,$id){
        $oferta = new Oferta;
        $oferta = $oferta->modificarOferta($params,$id);
        $data = array('status' => 'SUCCESS','mensaje'=>'Modificacion Exitosa');
        return $data;
    }
    public function verOferta($id){
        $oferta = new Oferta;
        $data = $oferta->verOferta($id);
        return $data;
    }
    public function listaOferta(){
        $oferta = new Oferta;
        $lista = $oferta->listaOferta();
        if(\is_object($lista)){
            $data = array('status' => 'SUCCESS','mensaje'=>'lista de productos','productos'=>$lista);
        }
        else{
            $data = 'No Hay Datos';
        }
        return $data;
    }
}
