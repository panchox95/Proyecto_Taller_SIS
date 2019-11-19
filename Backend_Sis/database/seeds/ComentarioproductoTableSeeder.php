<?php

use Illuminate\Database\Seeder;

class ComentarioproductoTableSeeder extends Seeder
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
            DB::table('comentarioproducto')->insert([
                'id_producto' => $faker->numberBetween(1,11),
                'id_user' => $faker->numberBetween(1,11),
                'comentario' => $faker->text(200),
                'calificacion' => $faker->numberBetween(1,5),
            ]);
        }
    }
}
