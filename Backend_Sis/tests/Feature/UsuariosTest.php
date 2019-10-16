<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuariosTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function conexion_perfil()
    {
        $response = $this->get('/api/verperfil');

        $response->assertStatus(200);
    }

    public function datoslogin(){
        $this->from('/api/login')
    ->post('api/login/', [
        'email' => '',
        'password' => '123456'
    ])
    ->assertRedirect('/api/login')
    ->assertSessionHasErrors(['email']);
    }
}
