<?php

namespace App\Http\Controllers;
use App\Http\BL\ServicioBL;
use App\Helpers\JwtAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ServiciosController extends Controller
{
    public function crearServicio(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validates = new Validator;
        $validate= $validates::make($params_array,[ // Validacion
            'nombre'=>'required',
            'precio'=>'required',
            'descripcion'=>'required',
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        } //Si la validacion es exitosa
        $servicio = new ServicioBL;
        if($servicio->existeServicio($params->nombre) == 0){
            $code=200;
            $data = $servicio->crearServicio($params);
            return response()->json($data,$code);    
        }   
        $code=404;
        $data=array('message'=>'El servicio ya existe','code'=>404,'status'=>'ERROR');
        return response()->json($data,$code);
    }

    public function listaServicios(){
        $servicio = new ServicioBL;
        $data=$servicio->listaServicios();
        $code = 200;
        return response()->json($data,$code);
    }

    public function eliminarServicio($id){
        $servicio = new ServicioBL;
        if($servicio->existeServicioID($id) == 1){
            $code=200;
            $data = $servicio->eliminarServicio($id);  
            return response()->json($data,$code);
        }   
        $code=404;
        $data=array('mensaje'=>'El Servicio no existe','code'=>404,'status'=>'ERROR',);    
        return response()->json($data,$code);
    }

    public function modificarServicio($id,Request $request){
        $json=$request->all('json',null);
        $params_array  = json_decode(json_encode( $json), true );
        
        $params=json_decode((json_encode($json)));
        //return $params_array;
        //Validamos
        $validates = new Validator;
        $validate= $validates::make(
            $params_array,[
                'nombre'=>'required',
                'precio'=>'required',
                'descripcion'=>'required',
            ]);
        if($validate->fails()){
            $data = $validate->errors();
            $code = 400;
            return response()->json($data,$code);
        }
        $servicio = new ServicioBL;
        if($servicio->existeServicioID($id) == 1){
            $code=200;
            $data=$servicio->modificarServicio($params,$id);
            return response()->json($data,$code);
        }  
        $data=array('mensaje'=>'El servicio no existe','code'=>404,'status'=>'ERROR',);
        return response()->json($data,$code);
    }
    public function verServicio($id_servicio){
        $servicio=new ServicioBL;
        if($servicio->existeServicioID($id_servicio) == 1){
            $data=$servicio->verServicio($id_servicio);
            $code=200;
            return response()->json($data,$code);
        }
        $data=array('mensaje'=>'servicio Inexistente','code'=>404,'status'=>'ERROR',);
        $code=404;
        return response()->json($data,$code);
    }
    
}