<?php

use Illuminate\Database\Seeder;

class ProductoTableSeeder extends Seeder
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
            DB::table('producto')->insert([
                'nombre' => $faker->company,
                'marca' => $faker->company,
                'cantidad' => $faker->numberBetween(100,500),
                'precio' => $faker->numberBetween(100,500),
                'descripcion' => $faker->text(200),
                'estado' => 'Activo',
                'tipo' => 'Producto'
            ]);
        }
    }
}
