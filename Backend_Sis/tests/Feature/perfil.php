<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class perfil extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVerPerfil(){
        $jwt = new JwtAuth();
        $token1 = $jwt->getToken();
        $response = $this->withHeaders([
            'Authorization'=>$token1,
        ])->json('GET','/api/verperfil');
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Perfil']);

    }

    public function testVerPerfilSinIniciarSesion(){
        $jwt = new JwtAuth();
        $token1 = $jwt->getToken();
        $response = $this->withHeaders([

        ])->json('GET','/api/verperfil');
        $response->assertStatus(400);
        $response->assertJson(['status'=>'ERROR']);
    }

      /*  public function testActualizarPerfil()
    {

        $jwt = new JwtAuth();
        $token1 = $jwt->getToken();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>   $token1,
        ])->json('PUT','/api/modificarperfil');
        $response->assertStatus(200);


       // $response = $this->put('/api/modificarperfil');


    }*/
}
