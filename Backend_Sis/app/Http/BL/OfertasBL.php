<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\OfertaProducto;
use App\Helpers\JwtAuth;
class OfertasBL
{
    public function crearOferta($params,$id_producto){
        $oferta = new OfertaProducto;
        $oferta->saveOferta($params,$id_producto);
        return array('status'=>'SUCCESS',
            'code'=>200,
            'message' =>'Oferta Creada',
        );
    }
    public function borrarOferta($id_producto){
        $oferta = new OfertaProducto;
        $oferta->borrarOferta($id_producto);
        return array('status' => 'SUCCESS','message'=>'Producto Eliminado');
    }
    public function modificarOferta($params,$id){
        $oferta = new OfertaProducto;
        $oferta = $oferta->modificarOferta($params,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }
    public function verOferta($id){
        $oferta = new OfertaProducto;
        return  array('status' => 'SUCCESS','message'=>'Oferta '.$id,'data'=>$oferta->verOferta($id));
    }
    public function listaOferta(){
        $oferta = new OfertaProducto;
        $lista = $oferta->listaOferta();
        //return gettype($lista);
        if($lista->isEmpty()){
            return array('status' => 'SUCCESS','message'=>'No Hay Ofertas');
        }
        return array('status' => 'SUCCESS','message'=>'lista de ofertas','ofertas'=>$lista);

    }
    public function existeOfertaID($id){
        $oferta = new OfertaProducto;
        return  $oferta->existeOfertaID($id);
    }
}
