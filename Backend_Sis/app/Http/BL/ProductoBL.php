<?php
namespace App\Http\BL;
use Illuminate\Database\Eloquent\Model;
use App\Producto;
use App\Servicio;
use App\Categoria;
use App\CategoriaProducto;
use App\Helpers\JwtAuth;
use Illuminate\Support\Collection;
class ProductoBL
{
    public function crearProducto($params){

        $producto = new Producto;
        $categoria = new Categoria;
        $categoriaproducto = new CategoriaProducto;
        $producto->saveProducto($params);
        $id=$producto->getIDProducto($params->nombre);
        $categoriaproducto->crearCategoria($id->id_producto,$params->categoria);
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
            $data = array('status' => 'SUCCESS','message'=>'lista de productos','productos'=>$lista);
        }
        else{
            $data=array(
                'message'=>'Producto Inexistente',
                'code'=>404,
                'status'=>'ERROR',);
        }
        return $data;
    }

    public function eliminarProducto($id){
        $producto = new Producto;
        $producto->eliminarProducto($id);
        return array('status' => 'SUCCESS','message'=>'Producto Eliminado');
    }

    public function modificarProducto($params,$id){
        $producto = new Producto;
        $producto = $producto->modificarProducto($params,$id);
        $data = array('status' => 'SUCCESS','message'=>'Modificacion Exitosa');
        return $data;
    }

    public function verProducto($id_producto){
        $producto = new Producto;
        $categoriaproducto = new CategoriaProducto;
        $prod =$producto->verProducto($id_producto);
        $cat = $categoriaproducto->verCategoria($id_producto);
        if(is_null($prod)){
            return array(
                'message'=>'Producto Inexistente',
                'code'=>404,
                'status'=>'ERROR',);
        }
        return array('status' => 'SUCCESS','message'=>'Producto','data'=>$prod,'categoria'=>$cat);
    }
    public function busquedaNombre($params){
        $producto = new Producto;
        $servicio = new Servicio;
        $dataproducto=$producto->busquedaNombre($params->nombre);
        $dataservicio=$servicio->busquedaNombre($params->nombre);

        if($dataproducto->isEmpty()){
                $dataproducto='Producto Inexistente';    
        }
        if($dataservicio->isEmpty()){
            $dataservicio='Servicio Inexistente';    
        }
       
        $data = array('status' => 'SUCCESS','message'=>'Producto','productos'=>11,'servicios'=>$dataservicio,'Productos'=>$dataproducto,'tipo'=>'nombre');
        return $data;
    }
}

