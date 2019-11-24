<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table ="categoriaproducto";

    public $timestamps = false;
    public function crearCategoria($id_producto,$id_categoria){
        $this->id_producto=$id_producto;
        $this->id_categoria=$id_categoria;
        $this->save();
    }
    public function verCategoria($id_producto){
        return CategoriaProducto::join('categoria','categoriaproducto.id_categoria','=','categoria.id_categoria')
                                ->select('nombre')
                                ->where('categoriaproducto.id_producto','=',$id_producto)
                                ->get();
    }

}
