<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table ="categoria";

    public $timestamps = false;
    public function listaCategoria(){
        //return 1;
        return  Categoria::select('*')->get(); 
    }
}
