<?php

namespace App\Http\Controllers;
use App\Http\BL\CategoriaBL;
use App\Http\Requests;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listaCategoria(){
        $categoria = new CategoriaBL;
        $data=$categoria->listaCategoria();
        $code = 200;
        return response()->json($data,$code);
    }
}
