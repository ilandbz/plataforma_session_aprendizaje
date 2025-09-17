<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitucionEducativa extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'direccion',
        'telefono',
        'email',
        'director',
        'sub_director',
    ];
}
