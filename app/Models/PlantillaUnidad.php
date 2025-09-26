<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantillaUnidad extends Model
{
    protected $fillable =[
        'region_id',
        'grado',
        'tiene_educacion_fisica',
        'tipo_id',
        'nombre_unidad',
        'numero_unidad',
        'situacion_significativa'
    ];
}
