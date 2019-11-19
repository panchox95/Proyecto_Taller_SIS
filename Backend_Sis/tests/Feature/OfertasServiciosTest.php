<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\JwtAuth;
class OfertasServiciosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListaOfertaServicios()
    {
        $response = $this->get('/api/listaofertaservicio');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de ofertas"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }

    public function testAgregarOfertaServicioComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearofertaservicio/1',[
            "descripcion"=>"descripcion serv adsda",
            "descuento"=>50
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);


    }



    public function testAgregarOfertaServicioSinSerNingunTipoDeUser(){
        $this->post('/api/crearofertaservicio/1', [
            "descripcion"=>"descripcion serv adsda",
            "descuento"=>50
        ])->assertStatus(403);

    }

   public function testEliminarOfertaServicioComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borrarofertaservicio/1');
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'servicio Eliminado']);



    }

    public function testEliminarOfertaServicioComoUsuario()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borrarofertaservicio/1');
        $response->assertStatus(404);
        $response->assertJson(['code'=>'404']);
        $response->assertJson(['status'=>'ERROR']);



    }

    public function testEliminarOfertaServicioSinSerUsuarioAuth()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borrarofertaservicio/1');
        $response->assertStatus(403);



    }

    public function testOfertaEliminarServicioSinID()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/borrarofertaservicio/');
        $response->assertStatus(404);
    }

    public function testModificarOfertaServicioAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarofertaservicio/2',[
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
        ])->json('PUT','/api/modificarofertaservicio/2',[
            "descripcion"=>"Oferta Modificada",
            "descuento"=>50

        ]);
        $response->assertStatus(404);
        $response->assertJson(['code'=>'404']);
        $response->assertJson(['status'=>'ERROR']);



    }

    public function testOfertaModificarServicioSinLogear()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarofertaservicio/2',[
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
        ])->json('PUT','/api/modificarofertaservicio',[
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
        ])->json('GET','/api/verofertaservicio/2',[


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
        ])->json('GET','/api/verofertaservicio/16565',[


        ]);
        $response->assertStatus(404);
    }
}
