<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SesionAprendizaje extends Model
{
    protected $fillable = ['area_plantilla_id','orden','titulo','genero'];
    public function areaPlantilla() :BelongsTo
    {
        return $this->belongsTo(AreaPlantilla::class, 'area_plantilla_id');
    }
}
