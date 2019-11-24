<?php

namespace App\Http\Controllers;

use App\Http\Middleware\JwtMiddleware;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class UserController extends Controller
{
    public function getProfile(){
        $orders=JwtMiddleware::user()->orders;
        $orders->transform(function ($order, $key){
            $order->cart =unserialize($order->cart);
            return $order;
        });
        //return view('user.profile', ['orders'=>$orders]);
        $code = 200;
        return response()->json($orders, $code);
    }

}
