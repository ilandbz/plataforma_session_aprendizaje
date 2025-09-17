<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profesor extends Model
{
    protected $fillable =['persona_id', 'institucion_educativa_id'];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }
    
    public function institucion_educativa(): BelongsTo
    {
        return $this->belongsTo(InstitucionEducativa::class, 'institucion_educativa_id');
    }
}
