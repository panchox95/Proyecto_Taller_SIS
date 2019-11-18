<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\JwtAuth;
class PromocionesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCrearOfertaComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearoferta/3',[
            "descripcion"=>"descripcion adsda",
            "descuento"=>50
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Oferta Creada']);

    }

    public function testCrearOfertaUsuarioNormal()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearoferta/3',[
            "descripcion"=>"descripcion adsda",
            "descuento"=>50
            ]);
        $response->assertStatus(500);


    }
    public function testCrearOfertaValorDescuentoDiferenteEntero()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearoferta/3',[
            "descripcion"=>"descripcion adsda",
            "descuento"=>"asd"
            ]);
        $response->assertJson(['code'=>'400']);
        $response->assertJson(['status'=>'ERROR']);
        $response->assertJson(['message'=>'El valor debe ser entero']);

    }



    public function testAgregarPromocionSinIniciarSesion(){
        $this->post('/api/crearoferta/1', [
            'descripcion'=>'asd',
            'descuento'=>'1'
        ])->assertStatus(403);

    }


    public function testListaOferta()
    {
        $response = $this->get('/api/listaoferta');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de ofertas"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }




    public function testEliminarOfertaServicioComoUsuario()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borraroferta/3');
        $response->assertStatus(500);

    }

    public function testEliminarOfertaServicioSinSerUsuarioAuth()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borraroferta/3');
        $response->assertStatus(403);



    }

    public function testOfertaEliminarServicioSinID()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borraroferta/');
        $response->assertStatus(404);
    }

    public function testModificarOfertaServicioAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificaroferta/3',[
            "descripcion"=>"Oferta Modificada",
            "descuento"=>50

        ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Modificacion Exitosa']);

    }

    public function testOfertaModificarServicioUserNormal()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificaroferta/3',[
            "descripcion"=>"Oferta Modificada",
            "descuento"=>50

        ]);
        $response->assertStatus(500);



    }

    public function testOfertaModificarServicioSinLogear()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificaroferta/3',[
            "descripcion"=>"Oferta Modificada",
            "descuento"=>50

        ]);
        $response->assertStatus(403);
        $response->assertJson(['status'=>'ERROR']);

        $response->assertJson(['message'=>'Token Invalido']);


    }

    public function testOfertaModificarServicioSinEspecificar()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificaroferta/',[
            "descripcion"=>"Oferta Modificada",
            "descuento"=>50

        ]);
        $response->assertStatus(404);



    }




    public function testVerOfertaServicioEspecifico()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('GET','/api/veroferta/3',[


        ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);

    }

    public function testVerOfertaServicioEspecificoInexistente()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('GET','/api/veroferta/3546654',[


        ]);
        $response->assertStatus(500);
    }
}
