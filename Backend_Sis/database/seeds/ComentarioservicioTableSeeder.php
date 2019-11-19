<?php

use Illuminate\Database\Seeder;

class ComentarioservicioTableSeeder extends Seeder
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
            DB::table('comentarioservicio')->insert([
                'id_servicio' => $faker->numberBetween(1,11),
                'id_user' => $faker->numberBetween(1,11),
                'comentario' => $faker->text(200),
                'calificacion' => $faker->numberBetween(1,5),
            ]);
        }
    }
}
