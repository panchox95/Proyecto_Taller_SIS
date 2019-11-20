<?php

use Illuminate\Database\Seeder;

class OfertaproductoTableSeeder extends Seeder
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
            DB::table('ofertaproducto')->insert([
                'id_producto' => $i*2,
                'descripcion' => $faker->text(200),
                'descuento' => $faker->numberBetween(1,50),
                'estado' => 'Activo',
                'imagepath'=>'https://images-na.ssl-images-amazon.com/images/I/51U13vbq%2BvL._SX425_.jpg',
            ]);
        }
    }
}
