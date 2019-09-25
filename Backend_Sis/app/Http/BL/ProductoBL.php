<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Producto;
use App\Helpers\JwtAuth;
class ProductoBL 
{
    public function crearProducto($params){
        
        $producto = new Producto;
        $producto->saveProducto($params);
        
        return array('status'=>'SUCCESS',
                    'code'=>200,
                    'message' =>'Creado '.$params->nombre.' '.$params->marca,
        );
    }
    public function existeProducto($nombre,$marca){
        $producto = new Producto;
        return $producto->existeProducto($nombre,$marca);
    }
    public function listaProductos(){
        $producto = new Producto;
        $lista = $producto->listadoProductos();
        if(\is_object($lista)){
            $data = array('status' => 'SUCCESS','mensaje'=>'lista de productos','productos'=>$lista);
        }
        else{
            $data = 'No Hay Datos';
        }
        return $data;
    }

}