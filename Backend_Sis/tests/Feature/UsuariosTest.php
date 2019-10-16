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

    public function testregistro(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'12312312s3A',
        ])->assertStatus(200);

    }

    public function testUsuarioConLetras(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'12312312s3A',
        ])->assertStatus(400);

    }

    public function testUsuarioSinCorreo(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'lovelacecito',
            'email'=>'',
            'password'=>'12312312s3A',
        ])->assertStatus(400);

    }

    public function testUsuarioSinContrasena(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'',
        ])->assertStatus(400);

    }

    public function testUsuarioSinLetrasContrasena(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'1231233',
        ])->assertStatus(400);

    }


    public function testUsuarioSinLetrasMayusculaContrasena(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'1231233ss',
        ])->assertStatus(400);

    }

    public function testUsuarioSinNombre(){
        $this->post('/api/registro', [
            'first_name'=>'',
            'last_name'=>'lovelacecito',
            'email'=>'jeff12223@asd.com',
            'password'=>'12312312s3A',
        ])->assertStatus(400);

    }

    public function testUsuarioSinApellido(){
        $this->post('/api/registro', [
            'first_name'=>'jeffreycito123',
            'last_name'=>'',
            'email'=>'jeff12223@asd.com',
            'password'=>'12312312s3A',
        ])->assertStatus(400);

    }


}
