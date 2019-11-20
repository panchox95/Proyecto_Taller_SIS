<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function saveUsuario($params,$pwd){
        $this->first_name=$params->first_name;
        $this->last_name=$params->last_name;
        $this->email=$params->email;
        $this->password=$pwd;
        $this->rol='Usuario';
        $this->save();
    }
}
