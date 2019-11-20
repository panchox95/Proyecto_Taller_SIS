<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mercaderias extends Model
{
    protected $fillable=['id_mercaderia','nombre','stock','descripcion','precio',
        'estado','imagepath','descuento','tipo'];
}
