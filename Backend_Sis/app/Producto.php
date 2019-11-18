<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table ="producto";
    protected $fillable = ['nombre', 'marca', 'cantidad', 'precio','descripcion','estado'];
    protected $primaryKey = 'id_producto';

    public $timestamps = false;


    public function saveProducto($params){
        $this->nombre=$params->nombre;
        $this->marca=$params->marca;
        $this->cantidad=$params->cantidad;
        $this->precio=$params->precio;
        $this->descripcion=$params->descripcion;
        $this->estado='activo';
        $this->tipo='producto';
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
    public function verProducto($id){
        return  Producto::select('*')->where('id_producto','=',$id)
                        ->where('producto.estado','=','activo')
                        ->first();
    }
    public function busquedaNombre($nombre,$dataservicio){
        return  Producto::select('producto.id_producto as id','producto.nombre','producto.marca','producto.cantidad','producto.precio','producto.descripcion','producto.tipo')
                        ->where('nombre','like', '%'.$nombre.'%','or','marca','like', '%'. $nombre .'%')
                        ->where('producto.estado','=','activo')
                        ->union($dataservicio)
                        ->paginate(5);
    }
    public function getIDProducto($nombre){
        return  Producto::select('id_producto')->where('nombre','=',$nombre)
        ->first();
    }
}
