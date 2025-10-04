<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function tipo()
    {
        return $this->belongsTo(TipoUnidadAprendizaje::class, 'tipo_id');
    }
    public function propositos(): HasMany
    {
        return $this->hasMany(PropositoAprendizaje::class, 'plantilla_unidad_id');
    }
}
