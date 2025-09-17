<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadAprendizaje\StoreUnidadAprendizajeRequest;
use App\Http\Requests\UnidadAprendizaje\UpdateUnidadAprendizajeRequest;
use App\Models\UnidadAprendizaje;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class UnidadAprendizajeController extends Controller
{
    public function store(StoreUnidadAprendizajeRequest $request)
    {
        $data = $request->validated();

        $unidad = UnidadAprendizaje::create([
            'numero_unidad'             => $data['numero_unidad'],
            'nombre_unidad'             => $data['nombre_unidad'],
            'tipo_id'                   => $data['tipo_id'],
            'institucion_educativa_id'  => $data['institucion_educativa_id'],
            'director'                  => $data['director'] ?? null,
            'region'                  => $data['region'] ?? null,
            'sub_director'              => $data['sub_director'] ?? null,
            'descripcion_unidad'        => $data['descripcion_unidad'] ?? null,
            'profesor'                  => $data['profesor'] ?? null,
            'grado'                     => $data['grado'] ?? null,
            'seccion'                   => $data['seccion'] ?? null,
            'fecha_inicio'              => $data['fecha_inicio'],
            'situacion_significativa'   => $data['situacion_significativa'] ?? null,
            'fecha_fin'                 => $data['fecha_fin'],
        ]);

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Unidad de aprendizaje registrada satisfactoriamente',
            'data'    => $unidad,
        ], 201);
    }

    public function show(Request $request)
    {
        $unidad = UnidadAprendizaje::findOrFail($request->id);
        return response()->json($unidad, 200);
    }

    public function update(UpdateUnidadAprendizajeRequest $request)
    {
        $data = $request->validated();

        $unidad = UnidadAprendizaje::findOrFail($request->id);
        $unidad->fill($data);
        $unidad->save();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Unidad de aprendizaje modificada satisfactoriamente',
            'data'    => $unidad,
        ], 200);
    }

    public function destroy(Request $request)
    {
        $unidad = UnidadAprendizaje::findOrFail($request->id);
        $unidad->delete();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Unidad de aprendizaje eliminada satisfactoriamente',
        ], 200);
    }

    public function all()
    {
        $registros = UnidadAprendizaje::orderBy('fecha_inicio', 'desc')
            ->orderBy('nombre_unidad', 'asc')
            ->get();

        return response()->json($registros, 200);
    }

    public function generarPdf(Request $request)
    {
        $registro = UnidadAprendizaje::with('institucion_educativa')->findOrFail($request->id);
        $data = [
            'registro'           => $registro,
        ];
        $pdf = Pdf::loadView('pdfs/UnidadAprendizaje', $data)->setPaper('a4', 'landscape');  
        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="unidad_aprendizaje.pdf"',
        ]);
    }
    public function listar(Request $request)
    {
        $buscar     = trim((string)$request->input('buscar', ''));
        $paginacion = (int)($request->input('paginacion', 20));
        $tipoId     = $request->input('tipo_id');                    // opcional
        $ieId       = $request->input('institucion_educativa_id');   // opcional

        $query = UnidadAprendizaje::query();

        // Filtros opcionales exactos
        if (!empty($tipoId)) {
            $query->where('tipo_id', $tipoId);
        }
        if (!empty($ieId)) {
            $query->where('institucion_educativa_id', $ieId);
        }

        // Búsqueda amplia
        if ($buscar !== '') {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_unidad', 'LIKE', "%{$buscar}%")
                  ->orWhere('descripcion_unidad', 'LIKE', "%{$buscar}%")
                  ->orWhere('situacion_significativa', 'LIKE', "%{$buscar}%")
                  ->orWhere('director', 'LIKE', "%{$buscar}%")
                  ->orWhere('sub_director', 'LIKE', "%{$buscar}%")
                  ->orWhere('profesor', 'LIKE', "%{$buscar}%")
                  ->orWhere('grado', 'LIKE', "%{$buscar}%")
                  ->orWhere('seccion', 'LIKE', "%{$buscar}%")
                  // búsqueda por número de unidad si el término es numérico
                  ->orWhere(function ($qq) use ($buscar) {
                      if (is_numeric($buscar)) {
                          $qq->where('numero_unidad', (int)$buscar);
                      }
                  });
            });
        }

        $registros = $query
            ->orderBy('fecha_inicio', 'desc')
            ->orderBy('nombre_unidad', 'asc')
            ->paginate($paginacion);

        return response()->json($registros, 200);
    }
}
