<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\StoreAreaRequest;
use App\Http\Requests\Area\UpdateAreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function store(StoreAreaRequest $request)
    {
        $role = Area::create([
            'nombre'    => $request->nombre,
            'abreviatura'    => $request->abreviatura,
        ]);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area Registrado satisfactoriamente'
        ],200);
    }
    public function show(Request $request)
    {
        $role = Area::where('id', $request->id)->first();
        return $role;
    }
    public function update(UpdateAreaRequest $request)
    {
        $area = Area::where('id',$request->id)->first();
        $area->nombre           = $request->nombre;
        $area->abreviatura           = $request->abreviatura;
        $area->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area modificado satisfactoriamente'
        ],200);
    }
    public function destroy(Request $request)
    {
        $role = Area::where('id', $request->id)->first();
        $role->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area eliminado satisfactoriamente'
        ],200);
    }
    public function all(){
        $roles = Area::get();
        return $roles;
    }
    public function listar(Request $request){
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;
        return Area::whereRaw('UPPER(nombre) LIKE ?', ['%'.$buscar.'%'])
            ->paginate($paginacion);
    }
}
