<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Servicio;
use App\Helpers\JwtAuth;
class ServicioBL
{
    public function crearServicio($params){

        $servicio = new Servicio;
        $servicio->saveServicio($params);
        
        return array('status'=>'SUCCESS',
            'code'=>200,
            'message' =>'Creado '.$params->nombre,
        );
    }
    public function existeServicio($nombre){
        $servicio = new Servicio;
        return $servicio->existeServicio($nombre);
    }

    public function existeServicioID($id){
        $servicio = new Servicio;
        return $servicio->existeServicioID($id);
    }
    public function listaServicios(){
        $servicio = new Servicio;
        $lista = $servicio->listadoServicios();
        if(\is_object($lista)){
            $data = array('status' => 'SUCCESS','message'=>'lista de servicios','servicios'=>$lista);
        }
        else{
            $data=array(
                'message'=>'Servicio Inexistente',
                'code'=>404,
                'status'=>'ERROR',);
        }
        return $data;
    }

    public function eliminarServicio($id){
        $servicio = new Servicio;
        $servicio->eliminarServicio($id);
        return array('status' => 'SUCCESS','message'=>'Servicio Eliminado');
    }

    public function modificarServicio($params,$id){
        $servicio = new Servicio;
        $servicio = $servicio->modificarServicio($params,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }

    public function verServicio($id_servicio){
        $servicio = new Servicio;
        $serv =$servicio->verServicio($id_servicio);
        if(is_null($serv)){
            return array(
                'message'=>'Servicio Inexistente',
                'code'=>404,
                'status'=>'ERROR',);
        }
        return array('status' => 'SUCCESS','message'=>'Servicio','data'=>$serv);
    }
    
}

