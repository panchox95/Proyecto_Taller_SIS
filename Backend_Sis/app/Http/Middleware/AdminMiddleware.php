<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\JwtAuth;
use App\User;
class AdminMiddleware
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
        $user = new User();
        $jwt = $request->header('Authorization',null);
        $decoded = $jwtAuth->decoded($jwt);
        $rol=$user->getrol($decoded->email);
        if($rol=='Admin'){
            return $next($request);
        }else{
            return array(
                'mensaje'=>'El usuario no es administrador',
                'code'=>404,
                'status'=>'ERROR');
        }
    }
}
