<?php

namespace App\Http\Controllers;
use App\Http\BL\PerfilBL;
use App\Http\BL\LoginBL;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Http\UploadedFile;
class PerfilController extends Controller
{
    public function verPerfil(Request $request){
        $perfil = new PerfilBL;
        $jwtAuth = new JwtAuth();
        $jwt = $request->header('Authorization',null);
        $decoded = $jwtAuth->decode($jwt);
        $data = $perfil->verPerfil($decoded);
        return $data;
    }
    public function  modificarPerfil(Request $request){
        $perfil = new PerfilBL;
        $jwt = $request->header('Authorization',null);
        $jwtAuth = new JwtAuth();
        //$input = $request->only(['user']);
        //$json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params=$request->toArray();
        //$params = json_decode((json_encode($json))); //Parametros para el uso
        //$params_array  = json_decode(json_encode( $json), true );
        //$params_array_user  = json_decode(json_encode( $input), true );
        //$paramsuser = json_decode((json_encode($input)));
       // $params_user  = json_decode(json_encode( $json->user), true );
       $user = $params['user'];
        //return $user['first_name'];
        $validate=false;
        $validate4= \Validator::make(
            $params,[
                'telfono'=>'number',
            ]
        );
        $validate5= \Validator::make(
            $params,[
                'telefono'=>'required',
                'direccion'=>'required',
            ]
        );
        $validate6= \Validator::make(
            $user,[
                'first_name'=>'required',
                'last_name'=>'required',
                'email'=>'required',

            ]
        );

        $message='';
        if($validate4->fails()){
            $validate=true;
            $message=$message.' El campo telefono debe tener solo numeros';
        }
        if($validate5->fails() || $validate6->fails()){
            $validate=true;
            $message=$message.' Se deben llenar todos los campos';
        }
        if($validate){
            $data=array(
                'status'=>'ERROR',
                'code' => 400,
                'message' => $message);
            $code=400;
            return response()->json($data,$code);
        }
        else{
            $decoded = $jwtAuth->decode($jwt);
            $data = $perfil->modificarPerfil($decoded,$params,$user);
            return $data;
        }

    }



    public function subirFoto(Request $request){
      // $file=$request->all();
        $file = $request->photo;

        $jwtAuth = new JwtAuth();
        $jwt = $request->header('Authorization',null);
        $decoded = $jwtAuth->decode($jwt);
        $user = new LoginBL();
        $name =$user->name($decoded->email);
        $nombre = $name.time();

        $path = public_path('uploads/'.$nombre.'.png');
        $url = '/uploads/'.$nombre;
        $image = Image::make( $file->getRealPath() );
        $image->save($path);
        $perfil = new PerfilBL;
        $data=$perfil->subirFoto($decoded,$url);
        return '<img src="'.$url.'" />';
        $data=array(
            'status'=>'SUCCESS',
            'code' => 200,
            'message' => $url);
        $code=200;
        return response()->json($data,$code);
    }
    public function mostrarFoto(Request $request){
        $jwt = $request->header('Authorization',null);
        $jwtAuth = new JwtAuth();
        $perfil = new PerfilBL;
        $decoded = $jwtAuth->decode($jwt);
        $url=$perfil->mostrarFoto($decoded);
        //$contents = Storage::get($url);
        $data=array(
            'status'=>'SUCCESS',
            'code' => 200,
            'message' => $url);
        $code=200;
        return $data;

    }

    public function getProfile(){
        $orders=JwtMiddleware::user()->orders;
        $orders->transform(function ($order, $key){
            $order->cart =unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders'=>$orders]);
    }
}
