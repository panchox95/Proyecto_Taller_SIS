<?php
namespace App\Http\Middleware;
use Closure;
class Cors
{
  public function handle($request, Closure $next)
  {
    
    header("Access-Control-Allow-Origin: *");
    //Allow OPTION METHOD
    $headers =['Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE', 
    'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization','Access-Control-Allow-Origin: http://localhost:4200'];

    if($request->getMethod()=="OPTIONS"){
        return response()->json('OK',200,$headers);
    }
    $response = $next($request);
    foreach($headers as $key => $value){
        $response->header($key,$value);
    }
    return $response;
  }
}