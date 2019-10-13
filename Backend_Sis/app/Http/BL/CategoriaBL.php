<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Categoria;
use App\Helpers\JwtAuth;
class CategoriaBL 
{
    public function listaCategoria(){
        $categoria = new Categoria;
        $lista = $categoria->listaCategoria();
        //return $lista;
        if(\is_object($lista)){
            
            $data = array('status' => 'SUCCESS','mensaje'=>'lista de categorias','categoria'=>$lista);
        }
        else{
             $data=array(
                'mensaje'=>'No existe Categorias',
                'code'=>404,
                'status'=>'ERROR',);
        }
        return $data;
    }
}