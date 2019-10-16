<?php

namespace App\Http\Middleware;

use Closure;
use App\Categoria;
class SQLMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $categoria = new Categoria;
        try{
            $categoria->listaCategoria();
        }
        catch(\PDOException $e){
            return response()->json(['CODE'=>404,'MESSAGE'=>'No Hay Conexion'],404);
        }
        return $next($request);
    }
}