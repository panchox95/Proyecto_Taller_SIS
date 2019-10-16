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
}
