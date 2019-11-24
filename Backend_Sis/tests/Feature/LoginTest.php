<?php

namespace Tests\Feature;

use Tests\TestCase;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
   public function testCargarSesion()
    {
        $response = $this->withSession(['foo' => 'bar'])
                         ->get('/api/login');
        $response->assertStatus(405);
    }

    public function testLoginCompleto(){
        $this->post('/api/login', [

            'email'=>'jeffrey123@gmail.com',
            'password'=>'jeffrey123',
        ])->assertStatus(200);

    }
    public function testLoginSinCorreo(){
        $this->post('/api/login', [

            'email'=>'',
            'password'=>'jeffrey123@gmail.com',
        ])->assertStatus(400);

    }

    public function testLoginSinContrasena(){
        $this->post('/api/login', [

            'email'=>'jeffrey123@gmail.com',
            'password'=>'',
        ])->assertStatus(400);

    }

    public function testLoginSinDatos(){
        $this->post('/api/login', [

            'email'=>'',
            'password'=>'',
        ])->assertStatus(400);

    }


    public function testDatosAdmin(){
        $this->post('/api/login', [

            'email'=>'admin@admin.com',
            'password'=>'Admin123',
        ])->assertStatus(200);

    }



}
