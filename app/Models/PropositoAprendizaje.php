<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropositoAprendizaje extends Model
{
    protected $fillable = [
        'descripcion',
        'plantilla_unidad_id',
        'area_id',
        'competencia_capacidades',
        'estandares',
        'desempeños',
        'evidencia',
        'instrumento_evaluacion'
    ];

    public function actividades(): HasMany
    {
        return $this->hasMany(ActividadAprendizaje::class, 'proposito_aprendizaje_id');
    }
    
    public function criterios(): HasMany
    {
        return $this->hasMany(CriterioEvaluacion::class, 'proposito_aprendizaje_id');
    }

    public function desempeños(): HasMany
    {
        return $this->hasMany(Desempeño::class, 'proposito_aprendizaje_id');
    }

    public function unidad(): BelongsTo
    {
        return $this->belongsTo(PlantillaUnidad::class, 'plantilla_unidad_id');
    }


}
