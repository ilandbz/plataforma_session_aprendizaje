<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropositoAprendizaje\StorePropositoAprendizajeRequest;
use App\Http\Requests\PropositoAprendizaje\UpdatePropositoAprendizajeRequest;
use App\Models\ActividadAprendizaje;
use App\Models\CriterioEvaluacion;
use App\Models\Desempeño;
use App\Models\PropositoAprendizaje;
use Illuminate\Http\Request;

class PropositoAprendizajeController extends Controller
{
    public function store(StorePropositoAprendizajeRequest $request)
    {
        $item = PropositoAprendizaje::firstOrCreate([
            'descripcion'              => $request->descripcion,
            'plantilla_unidad_id'      => $request->plantilla_unidad_id,
            'area_id'                  => $request->area_id,
            'competencia_capacidades'  => $request->competencia_capacidades,
            'estandares'               => $request->estandares,
            'evidencia'                => $request->evidencia,
            'instrumento_evaluacion'   => $request->instrumento_evaluacion,
        ]);

        foreach ($request->desempeños as $desempeño) {
            Desempeño::create([
                'proposito_aprendizaje_id' => $item->id,
                'descripcion' => $desempeño['nombre'],
            ]);
        }

        foreach ($request->criterio_evaluacions as $criterio) {
            CriterioEvaluacion::create([
                'proposito_aprendizaje_id' => $item->id,
                'descripcion' => $criterio['nombre'],
            ]);
        }

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Proposito Aprendizaje registrada satisfactoriamente',
            'data'    => $item,
        ], 200);
    }

    public function show(Request $request)
    {
        $item = PropositoAprendizaje::with([
            'desempeños',
            'criterios',
            'actividades'
        ])->where('id', $request->id)->first();
        return $item;
    }

    public function update(UpdatePropositoAprendizajeRequest $request)
    {
        $item = PropositoAprendizaje::where('id', $request->id)->first();

        $item->descripcion              = $request->descripcion;
        $item->plantilla_unidad_id      = $request->plantilla_unidad_id;
        $item->area_id                  = $request->area_id;
        $item->competencia              = $request->competencia;
        $item->capacidades              = $request->capacidades;
        $item->estandares               = $request->estandares;
        $item->evidencia                = $request->evidencia;
        $item->instrumento_evaluacion   = $request->instrumento_evaluacion;
        $item->save();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad modificada satisfactoriamente'
        ], 200);
    }

    public function destroy(Request $request)
    {
        $item = PropositoAprendizaje::where('id', $request->id)->first();
        $item->delete();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad eliminada satisfactoriamente'
        ], 200);
    }

    public function all(Request $request)
    {
        $items = PropositoAprendizaje::with([
            'desempeños',
            'criterios',
            'actividades'
        ])->where('plantilla_unidad_id', $request->id)->get();
        return $items;
    }
}
