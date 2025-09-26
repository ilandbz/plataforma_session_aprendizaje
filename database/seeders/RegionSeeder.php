<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['nombre' => 'SELVA'],
            ['nombre' => 'COSTA'],
            ['nombre' => 'SIERRA'],
        ];
        foreach ($datos as $dato) {
            Region::create($dato);
        }
    }
}
