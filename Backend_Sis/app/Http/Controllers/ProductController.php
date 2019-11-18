<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Helpers\JwtAuth;
use App\Http\Middleware\JwtMiddleware;
use App\Producto;
use App\Order;
use http\Client\Response;
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
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
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
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
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
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
       // return redirect()->route('product.shoppingCart');
    }

    public function getCart(){
        if(!Session::has('cart')){
            $code = 401;
            //return view('shop.shopping-cart', ['productos'=> null]);
            return response()->json(null,  $code );
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($cart->items, $cart->totalPrice , $conf );
        //return view('shop.shopping-cart', ['productos' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
        if(!Session::has('cart')){
           // return view('shop.shopping-cart');
            $conf=array(
                'status'=>'FAILURE',
                'message'=> 'no inicio sesion',
                'code' => 401);
            return Response()->json($conf);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total =$cart->totalPrice;
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json( $total, $conf );
        //return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request){
        if(!Session::has('cart')){
            $conf=array(
                'status'=>'SUCCESS',
                'code' => 201);
            //return redirect('shop.shoppingCart');
            return response($conf);
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
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json( $conf);

    }
}
