<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Usuario;
use App\Perfil;
use App\Helpers\JwtAuth;
class RegistroBL
{
    public function registro($params){
        //Instanciamos Clases
        $user = new User();
        $usuario = new Usuario();
        $perfil = new Perfil();
        //Comprobar si Existe el Usuario
        $pwd = hash('sha256',$params->password);
        if($user->existeCorreo($params->email) == 0){
            //Guardar
            $usuario->saveUsuario($params,$pwd);
            $id=$user->getIDUsuario($params->email);
            $perfil->savePerfil($id->id_user);
            return array(
                'status'=>'SUCCESS',
                'code' => 200,
                'message' => 'Usuario Creado Correctamente'
            );
        }
//No Guardar No Existe
        return array(
            'status'=>'ERROR',
            'code' => 400,
            'message' => 'Usuario Duplicado, no puede Registrarse'
        );
    }

}
