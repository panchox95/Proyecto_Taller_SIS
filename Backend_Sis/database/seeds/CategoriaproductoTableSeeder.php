<?php

use Illuminate\Database\Seeder;

class CategoriaproductoTableSeeder extends Seeder
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
            DB::table('categoriaproducto')->insert([
                'id_producto' => $i+1,
                'id_categoria' => $faker->numberBetween(1,7),
            ]);
        }
    }
}
