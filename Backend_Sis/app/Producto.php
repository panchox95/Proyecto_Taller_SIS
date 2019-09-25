<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table ="producto";

    public $timestamps = false;
    public function saveProducto($params){
        $this->nombre=$params->nombre;
        $this->marca=$params->marca; 
        $this->cantidad=$params->cantidad;
        $this->precio=$params->precio;
        $this->descripcion=$params->descripcion;
        $this->estado='activo'; 
        $this->save();
    }
    public function existeProducto($nombre,$marca){
        return  Producto::where(array('nombre'=>$nombre,'marca'=>$marca))->count();
    }
    public function existeProductoID($id){
        return  Producto::where(array('id_producto'=>$id))->count();
    }
    public function listadoProductos(){
        return $productos = Producto::select('*')
                            ->where('producto.estado','=','activo')
                            ->paginate(5);               
    }
    public function eliminarProducto($id){
        return Producto::where('id_producto',$id)
        ->update(["estado"=> 'borrado']);
    }
    public function modificarProducto($params,$id){
        return Producto::where('id_producto',$id)
        ->update(["nombre"=> $params->nombre,"marca"=>$params->marca,"cantidad"=>$params->cantidad,"precio"=> $params->precio,"descripcion"=> $params->descripcion]);
    }
}
