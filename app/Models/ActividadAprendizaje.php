<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadAprendizaje extends Model
{
    protected $fillable = [
        'proposito_aprendizaje_id',
        'desempeño_id',
        'criterio_evaluacion_id',
        'titulo',
        'orden',
        'enfoque_transversal',
        'actitud_observable',
        'competencia_transversal',
        'desempeños',
        'que_se_debe_hacer',
        'recursos_materiales',
        'inicio_duracion',
        'inicio_actividad',
        'desarrollo_duracion',
        'desarrollo_actividad',
        'cierre_duracion',
        'cierre_actividad',
    ];
}
