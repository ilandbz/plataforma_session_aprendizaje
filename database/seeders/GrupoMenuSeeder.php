<?php

namespace Database\Seeders;

use App\Models\GrupoMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GrupoMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grupos = [
            ['titulo' => 'Academico'],
            ['titulo' => 'Configuracion'],
        ];


        foreach ($grupos as $grupo) {
            GrupoMenu::updateOrInsert(['titulo' => $grupo['titulo']], $grupo);
        }
    }
}
