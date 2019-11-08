<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\JwtAuth;

class ProductosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_conexion_productos()
    {
        $response = $this->get('/api/listaproducto');

        $response->assertStatus(200);
    }

    public function testListaProductos()
    {
        $response = $this->get('/api/listaproducto');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de productos"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }
    /*
    public function testAgregarProductoComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearproducto',[

            "nombre"=>"testProducto",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba",
            "categoria"=>"1"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Creado testProducto mark1']);

    }
    */
    public function testAgregarProductoExistente()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearproducto',[
            "nombre"=>"prodprueba",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba",
            "categoria"=>"1"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'ERROR']);
        $response->assertJson(['message'=>'El producto ya existe']);

    }

    public function testAgregarProductoSinSerNingunTipoDeUser(){
        $this->post('/api/crearproducto', [
            'nombre'=>'Lehe',
            'marca'=>'Pil',
            'cantidad'=>'2',
            'precio'=>'3',
            'descripcion'=>'Buena',
        ])->assertStatus(403);

    }

  /* public function testEliminarProductoComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarproducto/9');
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);


    }*/

    public function testEliminarProductoComoUsuario()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarproducto/45');
        $response->assertStatus(405);

    }

    public function testEliminarProductoSinSerUsuarioAuth()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarproducto/45');
        $response->assertStatus(405);



    }

    public function testEliminarProductoSinID()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarproducto/');
        $response->assertStatus(404);
    }

    public function testModificarProductoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarproducto/1',[
            "nombre"=>"prod11133",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba modifcado"

        ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Modificacion Exitosa']);

    }

    public function testModificarProductoUserNormal()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarproducto/1',[
            "nombre"=>"prod11133",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba modifcado"

        ]);
        $response->assertStatus(500);



    }

    public function testModificarProductoSinLogear()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarproducto/1',[
            "nombre"=>"prod11133",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba modifcado"

        ]);
        $response->assertStatus(403);
        $response->assertJson(['status'=>'ERROR']);
        $response->assertJson(['code'=>'400']);
        $response->assertJson(['message'=>'Token Invalido']);


    }

    public function testModificarProductoSinEspecificar()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarproducto',[
            "nombre"=>"prod11133",
            "marca"=>"mark1",
            "cantidad"=>"100",
            "precio"=>"50",
            "descripcion"=>"un producto de prueba modifcado"

        ]);
        $response->assertStatus(404);



    }


}
