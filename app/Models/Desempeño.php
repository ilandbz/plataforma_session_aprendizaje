<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desempeño extends Model
{
    protected $fillable =[
        'proposito_aprendizaje_id',
        'descripcion',
    ];
}
