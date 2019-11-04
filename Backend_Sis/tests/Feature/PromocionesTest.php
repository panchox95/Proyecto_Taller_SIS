<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PromocionesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
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

    public function testAgregarPromocionSinSerADmi(){
        $this->post('/api/crearoferta/1', [
            'descripcion'=>'asd',
            'descuento'=>'1'
        ])->assertStatus(403);

    }
}
