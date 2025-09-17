<?php

namespace Database\Seeders;

use App\Models\InstitucionEducativa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitucionEducativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InstitucionEducativa::firstOrCreate([
            'codigo' => 'IE001',
            'nombre' => 'Institución Educativa Nacional',
            'direccion' => 'Av. Principal 123',
            'telefono' => '123456789',
            'email' => '',
            'director' => 'Director Ejemplar',
            'sub_director' => 'Subdirector Ejemplar',
        ]);

    }
}
