<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UnidadAprendizaje extends Model
{
    protected $fillable = [
        'numero_unidad',
        'nombre_unidad',
        'tipo_id',
        'institucion_educativa_id',
        'director',
        'region',
        'sub_director',
        'descripcion_unidad',
        'profesor',
        'grado',
        'seccion',
        'fecha_inicio',
        'situacion_significativa',
        'fecha_fin',
    ];

    public function institucion_educativa(): BelongsTo
    {
        return $this->belongsTo(InstitucionEducativa::class, 'institucion_educativa_id');
    }

}
