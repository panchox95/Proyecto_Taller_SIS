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
        $productos = new Producto;
        $producto = $productos::find($id_producto);
        $carrodecompras = new carrodecompras;
        $cart= $carrodecompras::carritoProductos(
            $id_user,
            );
        $session = Session;
        $cart = $session::has('cart') ? $session::get('cart') : null;
        if(!$cart)
        {
            $cart = new Cart($cart);
        }
        $cart->add($producto, $producto->id_producto);
        $session::put('cart', $cart);
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
        //return redirect()->route('product.index');
    }
}
