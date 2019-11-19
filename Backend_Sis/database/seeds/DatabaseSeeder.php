<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(App::environment() === 'production'){
            exit('No bro... No');
        }

        Eloquent::unguard();

        $tables = [
            'user',
            'perfil',
            'producto',
            'comentarioproducto',
            'ofertaproducto',
            'servicio',
            'ofertaservicio',
            'comentarioservicio',
            'categoria',
            'categoriaproducto',
            'categoriaservicio',
            'orders'
        ];

        foreach($tables as $table){
            DB::table($table)->truncate();
        }

        $this->call('UserTableSeeder');
        $this->call('PerfilTableSeeder');
        $this->call('ProductoTableSeeder');
        $this->call('ComentarioproductoTableSeeder');
        $this->call('OfertaproductoTableSeeder');
        $this->call('ServicioTableSeeder');
        $this->call('OfertaservicioTableSeeder');
        $this->call('ComentarioservicioTableSeeder');
        $this->call('CategoriaTableSeeder');
        $this->call('CategoriaproductoTableSeeder');
        $this->call('CategoriaservicioTableSeeder');
        $this->call('OrdersTableSeeder');
    }
}
