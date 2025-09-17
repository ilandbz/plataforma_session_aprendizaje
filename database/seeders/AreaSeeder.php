<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registros = [
            ['nombre' => 'Comunicación', 'abreviatura' => 'COM'],
            ['nombre' => 'Matemática', 'abreviatura' => 'MAT'],
            ['nombre' => 'Persona Social', 'abreviatura' => 'PSO'],
            ['nombre' => 'Tutoría', 'abreviatura' => 'TUT'],
            ['nombre' => 'Ciencia y Tecnología', 'abreviatura' => 'CTE'],
            ['nombre' => 'Arte', 'abreviatura' => 'ART'],
            ['nombre' => 'Religión', 'abreviatura' => 'REL'],
            ['nombre' => 'Educación Física', 'abreviatura' => 'EFIS'],
        ];
        foreach ($registros as $registro){
            Area::firstOrCreate($registro);
        }
        
    }
}
