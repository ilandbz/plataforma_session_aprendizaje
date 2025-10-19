<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Area extends Model
{
    protected $fillable = [
        'nombre',
        'abreviatura',
    ];
    public function plantillas() : BelongsToMany
    {
        return $this->belongsToMany(PlantillaUnidad::class, 'area_plantilla')
                    ->withTimestamps()
                    ->withPivot('id');
    }
    public function sessiones()
    {
        return $this->hasManyThrough(
            SesionAprendizaje::class,
            AreaPlantilla::class,
            'area_id',              // FK en area_plantillas
            'area_plantilla_id',    // FK en sesion_aprendizajes
            'id',                   // PK de areas
            'id'                    // PK de area_plantillas
        );
    }
}
