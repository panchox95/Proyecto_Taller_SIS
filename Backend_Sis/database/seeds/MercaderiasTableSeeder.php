<?php

use Illuminate\Database\Seeder;

class MercaderiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 100,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 300,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 10,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 50,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 100,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 20,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 100,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 250,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 15,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 100,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 600,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 0,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 100,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 10,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 0,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();
        $mercaderia = new \App\Mercaderias([
            'nombre'=> 'Dyson Upright Vacuum Cleaner',
            'stock'=> 100,
            'descripcion'=> 'Capacity (volume) - .42 gallon. Unrivaled Dyson suction*. Light to maneuver',
            'precio'=> 300,
            'estado'=> 'activo',
            'imagepath'=> 'https://images-na.ssl-images-amazon.com/images/I/714-YyZL0IL._SX466_.jpg',
            'descuento'=> 50,
            'tipo'=> 'producto',
        ]);
        $mercaderia->save();

    }

}
