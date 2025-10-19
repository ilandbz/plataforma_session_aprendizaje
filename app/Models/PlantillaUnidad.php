<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PlantillaUnidad extends Model
{
    protected $fillable =[
        'region_id',
        'grado',
        'tiene_educacion_fisica',
        'tipo_id',
        'titulo',
        'numero_unidad',
        'situacion_significativa',
        'filename'
    ];
    protected $casts = ['tiene_educacion_fisica' => 'bool'];
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function areas()
    {
        return $this->belongsToMany(
            Area::class,
            'area_plantillas',
            'plantilla_unidad_id',
            'area_id'
        )
        ->using(AreaPlantilla::class)
        ->withPivot('id');           // si no tienes timestamps, no pongas ->withTimestamps()
    }
    public function sesiones() {
        return $this->hasManyThrough(
            SesionAprendizaje::class,
            AreaPlantilla::class,   // modelo de la pivot
            'plantilla_unidad_id',  // FK en pivot -> plantilla
            'area_plantilla_id',    // FK en sesiones -> pivot
            'id',                   // PK plantilla
            'id'                    // PK pivot
        );
    }

}
