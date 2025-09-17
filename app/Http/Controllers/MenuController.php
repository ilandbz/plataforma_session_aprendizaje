<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\Rol;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function mostrarmenuslug(Request $request){
        return Menu::where('slug',$request->slug)->first();
    }

    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create([
            'nombre'    => $request->nombre,
            'slug'      => $request->slug,
            'icono'     => $request->icono,
            'grupo_id'  => $request->grupo_id ,
            'orden'     => 1,
        ]);
        $superusuario = Rol::where('nombre', 'Super Usuario')->first();
        $superusuario->menus()->attach($menu->id);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menu Registrado satisfactoriamente'
        ],200);

    }
    public function show(Request $request)
    {
        $menu = Menu::where('id', $request->id)->first();
        return $menu;
    }
    public function update(UpdateMenuRequest $request)
    {
        $request->validated();

        $menu = Menu::where('id',$request->id)->first();

        $menu->nombre           = $request->nombre;
        $menu->slug             = $request->slug;
        $menu->icono            = $request->icono;
        $menu->grupo_id         = $request->grupo_id;
        $menu->orden            = $request->orden;
        $menu->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Menu modificado satisfactoriamente'
        ],200);
    }

    public function destroy(Request $request)
    {
        $menu = Menu::where('id', $request->id)->first();
        $menu->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Cargo eliminado satisfactoriamente'
        ],200);
    }

    public function todos(){
        $menus = Menu::with('grupo:id,titulo')->get();
        return $menus;
    }
    public function listar(Request $request){
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;
        return Menu::with('grupo:id,titulo')->whereRaw('UPPER(nombre) LIKE ?', ['%'.$buscar.'%'])
            ->paginate($paginacion);
    }
}
