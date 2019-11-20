<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carrodecompras extends Model
{
    protected $fillable=['id_user','id_mercaderia','nombre','canrtidad','descripcion','precio'];
}



