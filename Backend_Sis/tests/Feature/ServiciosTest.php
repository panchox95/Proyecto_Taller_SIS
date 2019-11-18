<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\JwtAuth;

class ServiciosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testListaServicios()
    {
        $response = $this->get('/api/listaservicio');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de servicios"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }

    /*public function testAgregarServicioComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearservicio',[

          	"nombre"=>"servicioprueba12",
            "precio"=>"50",
             "descripcion"=>"un servicio de prueba"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);


    }*/

    public function testAgregarServicioExistente()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearservicio',[
            "nombre"=>"servicioprueba",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba"
            ]);
        $response->assertStatus(404);
        $response->assertJson(['status'=>'ERROR']);
        $response->assertJson(['message'=>'El servicio ya existe']);

    }

    public function testAgregarServicioSinSerNingunTipoDeUser(){
        $this->post('/api/crearservicio', [
            "nombre"=>"servicioprueba",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba"
        ])->assertStatus(403);

    }

   public function testEliminarServicioComoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/eliminarservicio/2');
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);


    }

    public function testEliminarServicioComoUsuario()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarservicio/2');
        $response->assertStatus(405);

    }

    public function testEliminarServicioSinSerUsuarioAuth()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/eliminarservicio/2');
        $response->assertStatus(405);



    }

    public function testEliminarServicioSinID()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api//eliminarservicio/');
        $response->assertStatus(404);
    }

    public function testModificarServicioAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarservicio/1',[
            "nombre"=>"serv1111",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba modifcado"

        ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Modificacion Exitosa']);

    }

    public function testModificarServicioUserNormal()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarservicio/1',[
            "nombre"=>"serv1111",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba modifcado"

        ]);
        $response->assertStatus(500);



    }

    public function testModificarServicioSinLogear()
    {
        $jwt = new JwtAuth();
        $token1 = '';
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarservicio/1',[
            "nombre"=>"serv1111",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba modifcado"

        ]);
        $response->assertStatus(403);
        $response->assertJson(['status'=>'ERROR']);
        $response->assertJson(['message'=>'Token Invalido']);


    }

    public function testModificarServicioSinEspecificar()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('PUT','/api/modificarservicio',[
            "nombre"=>"serv1111",
            "precio"=>"50",
            "descripcion"=>"un servicio de prueba modifcado"

        ]);
        $response->assertStatus(404);



    }




    public function testVerServicioEspecifico()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('GET','/api/verservicio/1',[


        ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Servicio']);

    }

    public function testVerServicioEspecificoInexistente()
    {
        $jwt = new JwtAuth();
        $token1 =  $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('GET','/api/verservicio/16565',[


        ]);
        $response->assertStatus(500);
    }
}
