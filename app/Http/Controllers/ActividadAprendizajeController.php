<?php

namespace App\Http\Controllers;

use App\Http\Requests\Actividad\StoreActividadRequest;
use App\Http\Requests\Actividad\UpdateActividadRequest;
use App\Models\ActividadAprendizaje;
use Illuminate\Http\Request;

class ActividadAprendizajeController extends Controller
{
    public function store(StoreActividadRequest $request)
    {
        $actividad = ActividadAprendizaje::create([
            'proposito_aprendizaje_id'  => $request->proposito_aprendizaje_id,
            'desempeño_id'              => $request->desempeño_id,
            'criterio_evaluacion_id'    => $request->criterio_evaluacion_id,
            'titulo'                    => $request->titulo,
            'orden'                     => $request->orden,
            'enfoque_transversal'       => $request->enfoque_transversal,
            'actitud_observable'        => $request->actitud_observable,
            'competencia_transversal'   => $request->competencia_transversal,
            'desempeños'                => $request->desempeños,
            'que_se_debe_hacer'         => $request->que_se_debe_hacer,
            'recursos_materiales'       => $request->recursos_materiales,
            'inicio_duracion'           => $request->inicio_duracion,
            'inicio_actividad'          => $request->inicio_actividad,
            'desarrollo_duracion'       => $request->desarrollo_duracion,
            'desarrollo_actividad'      => $request->desarrollo_actividad,
            'cierre_duracion'           => $request->cierre_duracion,
            'cierre_actividad'          => $request->cierre_actividad,

        ]);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area Registrado satisfactoriamente'
        ],200);
    }
    public function show(Request $request)
    {
        $role = ActividadAprendizaje::where('id', $request->id)->first();
        return $role;
    }
    public function update(UpdateActividadRequest $request)
    {
        $actividad = ActividadAprendizaje::where('id',$request->id)->first();
        $actividad->proposito_aprendizaje_id  = $request->proposito_aprendizaje_id;
        $actividad->desempeño_id              = $request->desempeño_id;
        $actividad->criterio_evaluacion_id    = $request->criterio_evaluacion_id;
        $actividad->titulo                    = $request->titulo;
        $actividad->orden                     = $request->orden;
        $actividad->enfoque_transversal       = $request->enfoque_transversal;
        $actividad->actitud_observable        = $request->actitud_observable;
        $actividad->competencia_transversal   = $request->competencia_transversal;
        $actividad->desempeños                = $request->desempeños;
        $actividad->que_se_debe_hacer         = $request->que_se_debe_hacer;
        $actividad->recursos_materiales       = $request->recursos_materiales;
        $actividad->inicio_duracion           = $request->inicio_duracion;
        $actividad->inicio_actividad          = $request->inicio_actividad;
        $actividad->desarrollo_duracion       = $request->desarrollo_duracion;
        $actividad->desarrollo_actividad      = $request->desarrollo_actividad;
        $actividad->cierre_duracion           = $request->cierre_duracion;
        $actividad->cierre_actividad          = $request->cierre_actividad;
        $actividad->save();

        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area modificado satisfactoriamente'
        ],200);
    }
    public function destroy(Request $request)
    {
        $role = ActividadAprendizaje::where('id', $request->id)->first();
        $role->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Area eliminado satisfactoriamente'
        ],200);
    }
    public function all(){
        $roles = ActividadAprendizaje::get();
        return $roles;
    }
    public function listar(Request $request){
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;
        return ActividadAprendizaje::whereRaw('UPPER(nombre) LIKE ?', ['%'.$buscar.'%'])
            ->paginate($paginacion);
    }
}
