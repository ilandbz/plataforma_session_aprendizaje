<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoUnidad\StoreTipoUnidadRequest;
use App\Http\Requests\TipoUnidad\UpdateTipoUnidadRequest;
use App\Models\TipoUnidadAprendizaje;
use Illuminate\Http\Request;

class TipoUnidadAprendizajeController extends Controller
{
    public function store(StoreTipoUnidadRequest $request)
    {
        $role = TipoUnidadAprendizaje::create([
            'nombre'    => $request->nombre,
        ]);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Unidad Registrado satisfactoriamente'
        ],200);
    }
    public function show(Request $request)
    {
        $role = TipoUnidadAprendizaje::where('id', $request->id)->first();
        return $role;
    }
    public function update(UpdateTipoUnidadRequest $request)
    {
        $area = TipoUnidadAprendizaje::where('id',$request->id)->first();
        $area->nombre           = $request->nombre;
        $area->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Unidad modificado satisfactoriamente'
        ],200);
    }
    public function destroy(Request $request)
    {
        $role = TipoUnidadAprendizaje::where('id', $request->id)->first();
        $role->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Tipo Unidad eliminado satisfactoriamente'
        ],200);
    }
    public function all(){
        $roles = TipoUnidadAprendizaje::get();
        return $roles;
    }
    public function listar(Request $request){
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;
        return TipoUnidadAprendizaje::whereRaw('UPPER(nombre) LIKE ?', ['%'.$buscar.'%'])
            ->paginate($paginacion);
    }
}
