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
            $checkToken = $jwtAuth->checkToken($jwt);
            //return $checkToken;
            if($checkToken){
            $decoded = $jwtAuth->decode($jwt);
            if($decoded->exp > time()){
              return $next($request);
            }else{
                $data=array(
                    'status'=>'ERROR',
                    'code' => 403,
                    'message' => 'Token Expirado');
                $code = 403;
           }
        }
        else{
            $data=array(
                'status'=>'ERROR',
                'code' => 403,
                'message' => 'Token Invalido');
            $code = 403;
        }
        return response()->json($data,$code);
        }
        catch(\ErrorException $e){
            $data=array(
                'status'=>'ERROR',
                'code' => 400,
                'message' => 'No existe un token');
            $code = 404;
            return response()->json($data,$code);
        }
        catch(\UnexpectedValueException $e){
            $data=array(
                'status'=>'ERROR',
                'code' => 400,
                'message' => 'No existe un token');
            $code = 404;
            return response()->json($data,$code);
        }
        
    }
}