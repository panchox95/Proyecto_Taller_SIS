<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Helpers\JwtAuth;
use App\Http\Middleware\JwtMiddleware;
use App\Producto;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
use App\Http\Requests;

class ProductController extends Controller
{

//    public function getAddToCart(Request $request, $id)
//    {
//        $product = Product::find($id);
//        $oldCart = Session::has('cart') ? Session::get('cart') : null;
//        $cart = new Cart($oldCart);
//        $cart->add($product, $product->id);
//        Session::put('cart', $cart);
//        Session::save();
//        return redirect()->route('product.index');
//    }
    public function getAddToCart(Request $request, $id_producto)
    {
        $producto = Producto::find($id_producto);
        $cart = Session::has('cart') ? Session::get('cart') : null;
        if(!$cart)
        {
            $cart = new Cart($cart);
        }
        $cart->add($producto, $producto->id_producto);
        Session::put('cart', $cart);
        $code = 200;
        return response()->json($code);
        //return redirect()->route('product.index');
    }

    public function getReduceByOne($id_producto){
        $oldCart=Session::has('cart') ? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->reduceByOne($id_producto);

        if (count($cart->items)>0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        $code = 200;
        return response()->json($code);
       // return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id_producto){
        $oldCart=Session::has('cart') ? Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->removeItem($id_producto);

        if (count($cart->items)>0){
            Session::put('cart', $cart);
        }else{
            Session::forget('cart');
        }
        $code = 200;
        return response()->json($code);
       // return redirect()->route('product.shoppingCart');
    }

    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart', ['productos'=> null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $code = 200;
        return response()->json(['productos' => $cart->items, 'totalPrice' => $cart->totalPrice], $code );
        //return view('shop.shopping-cart', ['productos' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
        if(!Session::has('cart')){
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total =$cart->totalPrice;
        $code = 200;
        return response()->json(['total' => $total], $code );
        //return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request){
        if(!Session::has('cart')){
            $code = 201;
            //return redirect('shop.shoppingCart');
            return response($code);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_5UoFetG19hEmgxJQ21vKT47k00bwx3yrDl');
        try{
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));
            $order= new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            $order->payment_id = $charge->id;

            JwtMiddleware::user()->orders()->save($order);
        }catch (\Exception $e){
            //return redirect()->route('checkout')->with('error', $e->getMessage());
            $code = 400;
            return response()->json($e->getMessage(), $code);
        }

        Session::forget('cart');
        //return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
        $code = 200;
        return response()->json( $code);

    }
}
