<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\JwtAuth;
class ComentariosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListaCometarioProducto()
    {
        $response = $this->get('/api/listacomentario/3');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de ofertas"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }

    public function testListaCometarioServicio()
    {
        $response = $this->get('/api/listacomentarioservicio/3');

        $response
        ->assertStatus(200)
        ->assertJson([
            'message' => "lista de comentarios"
        ]) ->assertJson([
            'status' => "SUCCESS"
        ]);
    }

    public function testAgregarComentarioProductoAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearcomentario/3',[
            "comentario"=>"Comentario prueba",
            "calificacion"=>"4",
            "tipo"=>"producto"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Comentario Creado']);


    }
    public function testAgregarComentarioProductoUser()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearcomentario/3',[
            "comentario"=>"Comentario prueba user",
            "calificacion"=>"4",
            "tipo"=>"producto"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Comentario Creado']);


    }

    public function testAgregarComentarioServiciooAdmi()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenAdmi();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearcomentario/3',[
            "comentario"=>"Comentario prueba servicio",
            "calificacion"=>"4",
            "tipo"=>"servicio"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Comentario Creado']);


    }
    public function testAgregarComentarioServicioUser()
    {
        $jwt = new JwtAuth();
        $token1 = $jwt->getTokenUser();
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Authorization'=>$token1,
        ])->json('POST','/api/crearcomentario/3',[
            "comentario"=>"Comentario prueba user servicio",
            "calificacion"=>"4",
            "tipo"=>"servicio"
            ]);
        $response->assertStatus(200);
        $response->assertJson(['status'=>'SUCCESS']);
        $response->assertJson(['message'=>'Comentario Creado']);


    }

    public function testAgregarComentarioSinIniciarSesion(){
        $this->post('/api/crearcomentario/3', [
            "comentario"=>"Comentario prueba user servicio",
            "calificacion"=>"4",
            "tipo"=>"servicio"
        ])->assertStatus(403);

    }

 

}
