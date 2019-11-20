<?php

namespace App\Http\Controllers;

use App\carrodecompras;
use App\Cart;
use App\Product;
use App\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function getAddToCart(Request $request, $id_producto, $id_user)
    {
        $producto = Producto::find($id_producto);
        $cart= carrodecompras::add(
            $id_user,

            );
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if(!$cart)
        {
            $cart = new Cart($cart);
        }
        $cart->add($producto, $producto->id_producto);
        Session::put('cart', $cart);
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
        //return redirect()->route('product.index');
    }
}
