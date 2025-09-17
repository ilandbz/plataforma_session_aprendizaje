<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model
{
    protected $appends = ['apenom', 'edad'];
    protected $fillable = [
        'dni',
        'ape_pat',
        'ape_mat',
        'primernombre',
        'otrosnombres',
        'fecha_nac',
        'ubigeo_nac',
        'genero',
        'celular',
        'email',
        'ruc',
        'estado_civil',
        'profesion',
    ];
    public function apenom(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "{$attributes['ape_pat']} {$attributes['ape_mat']} {$attributes['primernombre']} " . ($attributes['otrosnombres'] ?? ''),
        );
    }
    public function edad(): Attribute
    {
        return Attribute::make(
            get: function () {
                return DB::selectOne("SELECT calcularedad(?) AS edad", [$this->fecha_nac])->edad ?? 0;
            }
        );
    }
}
