<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\BL\ComentarioBL;
use Illuminate\Http\Request;
use App\Helpers\JwtAuth;
class UpdatePerfilTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  /*  public function testExample()
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
