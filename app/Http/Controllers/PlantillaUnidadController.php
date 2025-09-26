<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaUnidad\StorePlantillaUnidadRequest;
use App\Http\Requests\PlantillaUnidad\UpdatePlantillaUnidadRequest;
use App\Models\PlantillaUnidad;
use Illuminate\Http\Request;

class PlantillaUnidadController extends Controller
{
public function store(StorePlantillaUnidadRequest $request)
    {
        $item = PlantillaUnidad::create([
            'region_id'              => $request->region_id,
            'grado'                  => $request->grado,
            'tiene_educacion_fisica' => (int) filter_var($request->tiene_educacion_fisica, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? (int) $request->tiene_educacion_fisica,
            'tipo_id'                => $request->tipo_id,
            'nombre_unidad'          => $request->nombre_unidad,
            'numero_unidad'          => $request->numero_unidad,
            'situacion_significativa'=> $request->situacion_significativa
        ]);

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad registrada satisfactoriamente',
            'data'    => $item,
        ], 200);
    }

    public function show(Request $request)
    {
        $item = PlantillaUnidad::where('id', $request->id)->first();
        return $item;
    }

    public function update(UpdatePlantillaUnidadRequest $request)
    {
        $item = PlantillaUnidad::where('id', $request->id)->first();

        $item->region_id              = $request->region_id;
        $item->grado                  = $request->grado;
        $item->tiene_educacion_fisica = (int) filter_var($request->tiene_educacion_fisica, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? (int) $request->tiene_educacion_fisica;
        $item->tipo_id                = $request->tipo_id;
        $item->nombre_unidad          = $request->nombre_unidad;
        $item->numero_unidad          = $request->numero_unidad;
        $item->situacion_significativa= $request->situacion_significativa;
        $item->save();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad modificada satisfactoriamente'
        ], 200);
    }

    public function destroy(Request $request)
    {
        $item = PlantillaUnidad::where('id', $request->id)->first();
        $item->delete();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad eliminada satisfactoriamente'
        ], 200);
    }

    public function all()
    {
        $items = PlantillaUnidad::orderBy('grado')->get();
        return $items;
    }

    public function listar(Request $request)
    {
        $buscar     = mb_strtoupper($request->buscar ?? '');
        $paginacion = $request->paginacion ?? 10;

        // Búsqueda por "grado" (convierte a texto por si es numérico)
        return PlantillaUnidad::whereRaw('UPPER(CAST(grado AS CHAR)) LIKE ?', ['%'.$buscar.'%'])
            ->orderBy('grado')
            ->paginate($paginacion);
    }
}
