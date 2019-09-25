<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Perfil;
use App\Helpers\JwtAuth;
class PerfilBL 
{
    public function verPerfil($decoded){
        $id = $decoded->id_user;
        $producto = $producto->verPerfil($params,$id);
        $data = array('status' => 'SUCCESS','mensaje'=>'Modificacion Exitosa');
        return $data;
    }
    public function modificarPerfil($decoded,$params){
        $producto = new Producto;
        $id = $decoded->id_user;
        $producto = $producto->modificarPerfil($params,$id);
        $data = array('status' => 'SUCCESS','mensaje'=>'Modificacion Exitosa');
        return $data;
    }
}