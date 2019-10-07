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
    
    public function existeProductoID($id){
        $producto = new Producto;
        return $producto->existeProductoID($id);
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

    public function eliminarProducto($id){
        $producto = new Producto;
        $producto->eliminarProducto($id);
        return array('status' => 'SUCCESS','mensaje'=>'Producto Eliminado');
    }

    public function modificarProducto($params,$id){
        $producto = new Producto;
        $producto = $producto->modificarProducto($params,$id);
        $data = array('status' => 'SUCCESS','mensaje'=>'Modificacion Exitosa');
        return $data;
    }

    public function verProducto($id_producto){
        $producto = new Producto;
        $data = $producto->verProducto($id_producto);
        return $data;
    }
}