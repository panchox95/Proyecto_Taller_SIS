<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\JwtAuth;
class JwtMiddleware
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
        $jwtAuth = new JwtAuth();
        
        try{
            $jwt = $request->header('Authorization',null);
            
        }
        catch(\ErrorException $e){
            $data = "No existe un token";
            $code = 404;
            return response()->json($data,$code);
        }
        $checkToken = $jwtAuth->checkToken($jwt);
        if($checkToken){
            $decoded = $jwtAuth->decoded($jwt);
            if($decoded->exp > time()){
              return $next($request);
            }else{
              $data = "Token Expirado";
                $code = 403;
           }
        }
        else{
            $data = "Token Invalido";
            $code = 403;
        }
        return response()->json($data,$code);
    }
}