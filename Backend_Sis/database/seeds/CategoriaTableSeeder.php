<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('categoria')->insert([
            'nombre' => 'Equipo',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Modulo',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Hogar',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Conexion',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Sensor',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Cable',
        ]);
        DB::table('categoria')->insert([
            'nombre' => 'Instalacion',
        ]);
        
    }
}
