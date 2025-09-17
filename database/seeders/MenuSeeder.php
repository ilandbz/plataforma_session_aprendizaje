<?php

namespace Database\Seeders;

use App\Models\GrupoMenu;
use App\Models\Menu;
use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Rol::where('nombre', 'SUPER USUARIO')->first(); 

        $menus = [ 
            //Sistem
            [
                'nombre' => 'Usuarios',
                'slug' => 'gestion-usuarios',
                'icono' => 'fas fa-user-friends',
                'grupo_id'  => GrupoMenu::where('titulo', 'Configuracion')->value('id'),
                'orden' => 1,
            ],
            [
                'nombre' => 'Menús',
                'slug' => 'gestion-menus',
                'icono' => 'fas fa-list',
                'grupo_id'  => GrupoMenu::where('titulo', 'Configuracion')->value('id'),
                'orden' => 2,
            ],         
            [
                'nombre' => 'Unidades de Aprendizaje',
                'slug' => 'unidad-aprendizaje',
                'icono' => 'fas fa-list',
                'grupo_id'  => GrupoMenu::where('titulo', 'Academico')->value('id'),
                'orden' => 1,
            ],         
            [
                'nombre' => 'Areas',
                'slug' => 'areas-aprendizaje',
                'icono' => 'fa fa-book',
                'grupo_id'  => GrupoMenu::where('titulo', 'Academico')->value('id'),
                'orden' => 1,
            ],         
            [
                'nombre' => 'Tipo Unidad',
                'slug' => 'tipo-unidad-aprendizaje',
                'icono' => 'fas fa-layer-group',
                'grupo_id'  => GrupoMenu::where('titulo', 'Academico')->value('id'),
                'orden' => 1,
            ],                  
            [
                'nombre' => 'Institucion Educativa',
                'slug' => 'institucion-educativa',
                'icono' => 'fa-solid fa-school',
                'grupo_id'  => GrupoMenu::where('titulo', 'Academico')->value('id'),
                'orden' => 1,
            ],                  
            [
                'nombre' => 'Profesor',
                'slug' => 'profesor',
                'icono' => 'fas fa-user-graduate',
                'grupo_id'  => GrupoMenu::where('titulo', 'Academico')->value('id'),
                'orden' => 1,
            ],                  
        ];
        $menuIds = [];
        foreach($menus as $row){
            $menu = Menu::firstOrCreate($row);
            $menuIds[] = $menu->id;
        }
        $role->menus()->sync($menuIds);

    
    }
}
