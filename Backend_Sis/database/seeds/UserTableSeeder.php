<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserTableSeeder extends Seeder
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
            DB::table('user')->insert([
                'first_name' =>$faker->firstname,
                'last_name' =>$faker->lastname,
                'email' => $faker->email,
                'password' => hash('sha256','password'),
                'rol' => 'Usuario',
            ]);
        }
        DB::table('user')->insert([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => hash('sha256','Admin123'),
            'rol' => 'Admin',
        ]);

    }
}
