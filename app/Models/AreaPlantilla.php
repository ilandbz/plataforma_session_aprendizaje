<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AreaPlantilla extends Pivot
{
    protected $table = 'area_plantillas';
    protected $fillable = [
        'area_id',
        'plantilla_unidad_id',
    ];
    public $timestamps = false;
    public $incrementing = true;  // <-- AGREGAR ESTO
    protected $keyType = 'int';   // <-- AGREGAR ESTO
    public function area():BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function sessiones(): HasMany
    {
        return $this->hasMany(SesionAprendizaje::class, 'area_plantilla_id');
    }

    public function plantilla():BelongsTo
    {
        return $this->belongsTo(PlantillaUnidad::class);
    }
}
