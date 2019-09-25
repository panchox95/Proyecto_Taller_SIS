<?php

namespace App\Http\Middleware;

use Closure;
use App\Producto;
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
        $producto = new Producto;
        try{
            $producto->listadoProductos();
        }
        catch(\PDOException $e){
            return response()->json(['CODE'=>404,'MESSAGE'=>'No Hay Conexion'],404);
        }
        return $next($request);
    }
}