<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Perfil;
use App\User;
use App\Helpers\JwtAuth;
class PerfilBL 
{
    public function verPerfil($decoded){
        $perfil = new Perfil;
        $id = $decoded->id_user;
        $perfildata= $perfil->verPerfil($id);
        $data = array('status' => 'SUCCESS','message'=>'Perfil','data'=>$perfildata);
        return $data;
    }
    public function modificarPerfil($decoded,$params){
        $perfil = new Perfil;
        $user = new User;
        $id = $decoded->id_user;
        $perfil->modificarPerfil($params,$id);
        $user->modificarPerfil($params->user,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }
    public function subirFoto($decoded,$name){
        $perfil = new Perfil;
        $id = $decoded->id_user;
        $perfil->subirFoto($id,$name);
        return array('status' => 'SUCCESS','message'=>'Foto actualizada');

    }
    public function mostrarFoto($decoded){
        $perfil = new Perfil;
        $id = $decoded->id_user;
        $data=$perfil->mostrarFoto($id);
        return array('status' => 'SUCCESS','data'=>$data);
        
    }
}