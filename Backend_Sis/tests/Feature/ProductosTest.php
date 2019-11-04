<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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


    public function testAgregarProductoSinSerADmi(){
        $this->post('/api/crearproducto', [
            'nombre'=>'Lehe',
            'marca'=>'Pil',
            'cantidad'=>'2',
            'precio'=>'3',
            'descripcion'=>'Buena',
        ])->assertStatus(403);

    }





}
