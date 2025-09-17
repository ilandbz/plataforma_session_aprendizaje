<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitucionEducativa\StoreInstitucionEducativaRequest;
use App\Http\Requests\InstitucionEducativa\UpdateInstitucionEducativaRequest;
use App\Models\InstitucionEducativa;
use Illuminate\Http\Request;

class InstitucionEducativaController extends Controller
{
    public function store(StoreInstitucionEducativaRequest $request)
    {
        // Valida según tu FormRequest
        $data = $request->validated();

        $institucion = InstitucionEducativa::create([
            'codigo'        => $data['codigo'],
            'nombre'        => $data['nombre'],
            'direccion'     => $data['direccion'] ?? null,
            'telefono'      => $data['telefono'] ?? null,
            'email'         => $data['email'] ?? null,
            'director'      => $data['director'] ?? null,
            'sub_director'  => $data['sub_director'] ?? null,
        ]);

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Institución educativa registrada satisfactoriamente',
            'data'    => $institucion,
        ], 201);
    }

    public function show(Request $request)
    {
        $institucion = InstitucionEducativa::findOrFail($request->id);

        return response()->json($institucion, 200);
    }

    public function update(UpdateInstitucionEducativaRequest $request)
    {
        $data = $request->validated();

        $institucion = InstitucionEducativa::findOrFail($request->id);
        $institucion->codigo       = $data['codigo'] ?? $institucion->codigo;
        $institucion->nombre       = $data['nombre'] ?? $institucion->nombre;
        $institucion->direccion    = $data['direccion'] ?? $institucion->direccion;
        $institucion->telefono     = $data['telefono'] ?? $institucion->telefono;
        $institucion->email        = $data['email'] ?? $institucion->email;
        $institucion->director     = $data['director'] ?? $institucion->director;
        $institucion->sub_director = $data['sub_director'] ?? $institucion->sub_director;
        $institucion->save();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Institución educativa modificada satisfactoriamente',
            'data'    => $institucion,
        ], 200);
    }

    public function destroy(Request $request)
    {
        $institucion = InstitucionEducativa::findOrFail($request->id);
        $institucion->delete();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Institución educativa eliminada satisfactoriamente',
        ], 200);
    }

    public function all()
    {
        $registros = InstitucionEducativa::orderBy('nombre', 'asc')->get();

        return response()->json($registros, 200);
    }

    public function listar(Request $request)
    {
        $buscar      = trim((string) $request->input('buscar', ''));
        $paginacion  = (int) ($request->input('paginacion', 20));

        $query = InstitucionEducativa::query();

        if ($buscar !== '') {
            // Búsqueda amplia por varios campos
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                  ->orWhere('codigo', 'LIKE', "%{$buscar}%")
                  ->orWhere('director', 'LIKE', "%{$buscar}%")
                  ->orWhere('sub_director', 'LIKE', "%{$buscar}%")
                  ->orWhere('email', 'LIKE', "%{$buscar}%")
                  ->orWhere('telefono', 'LIKE', "%{$buscar}%")
                  ->orWhere('direccion', 'LIKE', "%{$buscar}%");
            });
        }

        $registros = $query->orderBy('nombre', 'asc')->paginate($paginacion);

        return response()->json($registros, 200);
    }
}
