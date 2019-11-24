<?php

use Illuminate\Database\Seeder;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 10; $i++) {
            DB::table('servicio')->insert([
                'nombre' => $faker->company,
                'precio' => $faker->numberBetween(100,500),
                'descripcion' => $faker->text(200),
                'estado' => 'Activo',
                'tipo' => 'Servicio'
            ]);
        }
        DB::table('servicio')->insert([
            'nombre' => 'servicioprueba',
            'precio' => 50,
            'descripcion' => 'un servicio de prueba',
            'estado' => 'Activo',
            'tipo' => 'Servicio'
        ]);
    }
}
