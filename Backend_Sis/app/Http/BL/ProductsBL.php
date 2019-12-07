<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Producto;
use App\Servicio;
use App\Categoria;
use App\CategoriaProducto;
use App\Helpers\JwtAuth;
use Illuminate\Support\Collection;
class ProductsBL
{

    public function listaCarrito($request){
        $producto = new Producto;
        $lista = $producto->listadoProductos();
        if(\is_object($lista)){
            return array('status' => 'SUCCESS','message'=>'lista de productos en el carrito','carrito'=>$lista);
        }

            return array(
                'message'=>'No se tiene carrito',
                'code'=>404,
                'status'=>'ERROR',);

    }

    public function eliminarProducto($id){
        $producto = new Producto;
        $producto->eliminarProducto($id);
        return array('status' => 'SUCCESS','message'=>'Producto Eliminado');
    }

}

