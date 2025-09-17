<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GrupoMenu extends Model
{
    public $timestamps = false;
    protected $fillable =['titulo'];
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'grupo_id');
    }
}
