<?php

use Illuminate\Database\Seeder;

class OfertaservicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i <= 5; $i++) {
            DB::table('ofertaservicio')->insert([
                'id_servicio' => $i*2,
                'descripcion' => $faker->text(200),
                'descuento' => $faker->numberBetween(1,50),
                'estado' => 'Activo',
            ]);
        }
    }
}
