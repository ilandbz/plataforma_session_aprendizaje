<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['SUPER USUARIO', 'PROFESOR', 'ESTUDIANTE'];

        foreach ($roles as $role) {
            Rol::firstOrCreate(['nombre' => $role]);
        }
    }
}
