<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superusuario = User::firstOrCreate([
            'name' => 'admin',
            'password' => Hash::make('admin12345'),
            'role_id' => Rol::where('nombre', 'SUPER USUARIO')->value('id'),
        ]);


        $docente = User::firstOrCreate([
            'name' => 'cristian',
            'password' => Hash::make('45532962'),
            'role_id' => Rol::where('nombre', 'PROFESOR')->value('id'),
        ]);



    }
}
