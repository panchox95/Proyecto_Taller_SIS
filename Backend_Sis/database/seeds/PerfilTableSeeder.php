<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class PerfilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('perfil')->insert([
            'id_user' => 1,
            'telefono' => 222222201,
            'direccion' => Str::random(10),
            'foto' =>  'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png',
            'tarjeta' => 12345601,
            'zipcode' => 00000,
        ]);
        for ($i = 0; $i <= 10; $i++) {
            DB::table('perfil')->insert([
                'id_user' => $i+2,
                'telefono' => $faker->numberBetween(20000000,29999999),
                'direccion' => $faker->address,
                'foto' =>  'https://www.sackettwaconia.com/wp-content/uploads/default-profile.png',
                'tarjeta' => 12345602+$i,
                'zipcode' => 00000,
            ]);
        }
    }
}
