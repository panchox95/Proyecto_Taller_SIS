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
    public function modificarPerfil($decoded,$params,$userparams){
        $perfil = new Perfil;
        $user = new User;
        $id = $decoded->id_user;
        $perfil->modificarPerfil($params,$id);
        $user->modificarPerfil($userparams,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }
    public function subirFoto($decoded,$path){
        $perfil = new Perfil;
        $id = $decoded->id_user;
        $perfil->subirFoto($id,$path);
        return array('status' => 'SUCCESS','message'=>'Foto actualizada');

    }
    public function mostrarFoto($decoded){
        $perfil = new Perfil;
        $id = $decoded->id_user;
        $data=$perfil->verPerfil($id);
        return $data;
        
    }
}