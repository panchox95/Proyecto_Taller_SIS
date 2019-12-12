<?php

namespace App\Http\Controllers;

use App\carrodecompras;
use App\Cart;
use App\Helpers\JwtAuth;
use App\Http\BL\ProductsBL;
use App\Http\Middleware\JwtMiddleware;
use App\Producto;
use App\Order;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;
use App\Http\Requests;
use function Sodium\increment;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function postAddToCart(Request $request)
    {
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validates = new Validator;
        $validate= $validates::make($params_array,[ // Validacion
            'id_usuario'=>'required',
            'id_producto'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }

        $productos = new Producto;
        $producto =$productos->verProducto($params->id_producto);
        $carro= DB::table('carrodecompras')
            ->updateOrInsert(
                ['id_user' => $params->id_usuario, 'id_mercaderia' => $params->id_producto, 'estado'=>'espera'],
                [
                    'nombre' => $producto->nombre,
                    'cantidad' => \DB::raw('cantidad + 1'),
                    'descripcion' => $producto->descripcion,
                    'precio' => $producto->precio,
                ]
            );
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
    }

    public function getReduceByOne(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validates = new Validator;
        $validate= $validates::make($params_array,[ // Validacion
            'id_usuario'=>'required',
            'id_producto'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }

        $productos = new Producto;
        $producto =$productos->verProducto($params->id_producto);
        $carro= DB::table('carrodecompras')
            ->updateOrInsert(
                ['id_user' => $params->id_usuario, 'id_mercaderia' => $params->id_producto, 'estado'=>'espera'],
                [
                    'nombre' => $producto->nombre,
                    'cantidad' => \DB::raw('cantidad - 1'),
                    'descripcion' => $producto->descripcion,
                    'precio' => $producto->precio,
                ]
            );
        // return($producto);
//        $carrodecompras = new carrodecompras();
//        $carrodecompras->saveCarro($params, $producto);
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
    }

    public function getRemoveItem(Request $request){
        $json = $request->all('json',null); //Recibimos el JSON enviado por el Frontend
        $params_array  = json_decode(json_encode( $json), true ); //Parametros para la validacion
        $params = json_decode((json_encode($json))); //Parametros para el uso
        $validates = new Validator;
        $validate= $validates::make($params_array,[ // Validacion
            'id_usuario'=>'required',
            'id_producto'=>'required'
        ]);
        if($validate->fails()){  //Si la validacion falla
            return response()-> json($validate->errors(),400);
        }

        $productos = new Producto;
        $producto =$productos->verProducto($params->id_producto);
        $carro= DB::table('carrodecompras')
            ->where('id_user','=', $params->id_usuario )
            ->where('id_mercaderia','=', $params->id_producto )
            ->where('estado','=', 'espera' )
            ->delete();
        // return($producto);
//        $carrodecompras = new carrodecompras();
//        $carrodecompras->saveCarro($params, $producto);
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json($conf);
    }

    public function getCart($id_user){

        $carro=DB::table('carrodecompras')
            ->where('id_user', $id_user)
            ->where('estado', 'espera')
            ->where('cantidad','>',0)
            ->get();
        $total=DB::table('carrodecompras')
            ->where('id_user', $id_user)
            ->where('estado', 'espera')
            ->sum(DB::raw('carrodecompras.cantidad * carrodecompras.precio'));
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);

        return response()->json(['productos'=>$carro, 'totalPrice' => $total]);
        //return view('shop.shopping-cart', ['productos' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout($id_user){
        $total=DB::table('carrodecompras')
            ->where('id_user', $id_user)
            ->where('estado', 'espera')
            ->sum(DB::raw('carrodecompras.cantidad * carrodecompras.precio'));
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json( $total );
        //return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request){
        $cart = DB::table('carrodecompras')
            ->where('id_user',12)
            ->where('estado', 'espera')
            ->where('cantidad','>',0)
            ->get();
        $total=DB::table('carrodecompras')
            ->where('id_user', 12)
            ->where('estado', 'espera')
            ->sum(DB::raw('carrodecompras.cantidad * carrodecompras.precio'));
        $stripe = new Stripe;
        $stripe::setApiKey('sk_test_5UoFetG19hEmgxJQ21vKT47k00bwx3yrDl');
        try{
//            $charge = new Charge;
//            $charge = $charge::create(array(
//                "amount" => $total * 100,
//                "currency" => "usd",
//                "source" => $request->token, // obtained with Stripe.js
//                "description" => "Test Charge"
//            ));
            $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1999,
                'currency' => 'usd'
            ));

            return 'Charge successful, you get the course!';
        }catch (\Exception $e){
            //return redirect()->route('checkout')->with('error', $e->getMessage());
            $code = 400;
            return response()->json($e->getMessage(), $code);
        }

//        $deletecart = DB::table('carrodecompras')
//            ->where('id_user',12)
//            ->where('estado', 'espera')
//            ->where('cantidad','>',0)
//            ->delete();

        //return redirect()->route('product.index')->wits('success', 'Successfully purchased products!');
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);

        return response()->json( $conf);

    }

    public function postCheckoutOrder($id_user){
        $carro= DB::table('carrodecompras')
            ->updateOrInsert(
                ['id_user' => $id_user],
                [
                     'estado'=>'vendido',
                ]
            );
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);
        return response()->json( $conf );
        //return view('shop.checkout', ['total' => $total]);
    }

    public function getOrders($id_user){

        $carro=DB::table('carrodecompras')
            ->where('id_user', $id_user)
            ->where('estado', 'vendido')
            ->where('cantidad','>',0)
            ->get();
        $total=DB::table('carrodecompras')
            ->where('id_user', $id_user)
            ->where('estado', 'vendido')
            ->sum(DB::raw('carrodecompras.cantidad * carrodecompras.precio'));
        $conf=array(
            'status'=>'SUCCESS',
            'code' => 200);

        return response()->json(['productos'=>$carro, 'totalPrice' => $total]);
        //return view('shop.shopping-cart', ['productos' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }
}
