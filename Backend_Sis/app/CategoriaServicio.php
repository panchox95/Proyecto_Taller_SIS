<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaServicio extends Model
{
    protected $table ="categoriaservicio";

    public $timestamps = false;
    
    public function vercategoria($id_servicio){
        return CategoriaProducto::join('categoriaservicio.id_categoria','=','categoria.id_categoria')
                                ->select('categoria.nombre')
                                ->where('categoriaservicio.id_servicio','=',$id_servicio)
                                ->get();
    }
}
