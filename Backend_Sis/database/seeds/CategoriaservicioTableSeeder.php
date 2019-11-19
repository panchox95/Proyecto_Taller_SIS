<?php

use Illuminate\Database\Seeder;

class CategoriaservicioTableSeeder extends Seeder
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
            DB::table('categoriaservicio')->insert([
                'id_servicio' => $i+1,
                'id_categoria' => $faker->numberBetween(1,7),
            ]);
        }
    }
}
