<?php

namespace Database\Seeders;

use App\Models\TipoUnidadAprendizaje;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUnidadAprendizajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = ['COGNITIVA', 'MOTORA', 'SOCIOEMOCIONALES', 'ARTISTICOS', 'ACTITUDINALES'];

        foreach ($registros as $registro) {
            TipoUnidadAprendizaje::create(['nombre' => $registro]);
        }
    }
}
