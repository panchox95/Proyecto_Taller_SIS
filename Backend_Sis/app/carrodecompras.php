<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class carrodecompras extends Model
{
    protected $table = 'carrodecompras';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function carritoProductos(){

//        $this->id_mercaderia=$params->id_producto;
//        $this->nombre=$params->nombre;
//        $this->descripcion=$params->descripcion;
//        $this->precio=$params->precio;
//        $this->estado=$params->estado;
//        $this->save();
    }
    /*$carro=DB::table('carrodecompras')

            ->updateOrInsert(
            ['id_user' => $params->id_usuario, 'id_mercaderia' => $producto->id_producto, 'estado'=>'espera'],
            [
                'nombre' => $producto->nombre,
                'cantidad' => \DB::raw('cantidad + 1'),
                'descripcion' => $producto->descripcion,
                'precio'=> $producto->precio
            ]
        );*/
    public function saveCarro($params, $producto){
        $this->id_mercaderia=$params->id_producto;
        $this->id_user=$params->id_usuario;
        $this->nombre=$producto->nombre;

        $this->estado='espera';
        $this->save();
    }
    public function mostrarCarro($id_usuario){
        return  carrodecompras::select('*')->where('id_user','=',$id_usuario)

            ->get();
    }
}



