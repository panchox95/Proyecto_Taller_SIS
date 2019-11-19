<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\OfertaServicio;
use App\Helpers\JwtAuth;
class OfertasServiciosBL
{
    public function crearOferta($params,$id_servicio){
        $oferta = new OfertaServicio;
        $oferta->saveOferta($params,$id_servicio);
        return array('status'=>'SUCCESS',
            'code'=>200,
            'message' =>'Oferta Creada',
        );
    }
    public function borrarOferta($id_servicio){
        $oferta = new OfertaServicio;
        $oferta->borrarOferta($id_servicio);
        return array('status' => 'SUCCESS','message'=>'servicio Eliminado');
    }
    public function modificarOferta($params,$id){
        $oferta = new OfertaServicio;
        $oferta = $oferta->modificarOferta($params,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }
    public function verOferta($id){
        $oferta = new OfertaServicio;
        $data =  array('status' => 'SUCCESS','message'=>'Oferta '.$id,'data'=>$oferta->verOferta($id));

        return $data;
    }
    public function listaOferta(){
        $oferta = new OfertaServicio;
        $lista = $oferta->listaOferta();
        //return gettype($lista);
        if($lista->isEmpty()){
            return array('status' => 'SUCCESS','message'=>'No Hay Ofertas');
        }
        return array('status' => 'SUCCESS','message'=>'lista de ofertas','ofertas'=>$lista);
        
        
    }
    public function existeOfertaID($id){
        $oferta = new OfertaServicio;
        return  $oferta->existeOfertaID($id);
    }
}
