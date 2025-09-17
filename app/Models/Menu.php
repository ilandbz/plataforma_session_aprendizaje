<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable =['id','nombre','slug','icono','orden', 'grupo_id'];

    public $timestamps = false;
    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }
    public function grupo(): BelongsTo
    {
        return $this->belongsTo(GrupoMenu::class, 'grupo_id');
    }
}
