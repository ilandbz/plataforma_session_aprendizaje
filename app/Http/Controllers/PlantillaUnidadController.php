<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaUnidad\StorePlantillaUnidadRequest;
use App\Http\Requests\PlantillaUnidad\StoreSessionesRequest;
use App\Http\Requests\PlantillaUnidad\UpdatePlantillaUnidadRequest;
use App\Models\AreaPlantilla;
use App\Models\PlantillaUnidad;
use App\Models\SesionAprendizaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PlantillaUnidadController extends Controller
{
    public function store(StorePlantillaUnidadRequest $request)
    {
        $data = $request->validated();

        $data['tiene_educacion_fisica'] = $request->boolean('tiene_educacion_fisica');

        return DB::transaction(function () use ($request, $data) {
            $plantilla = PlantillaUnidad::create([
                'grado'                   => $data['grado'],
                'numero_unidad'           => $data['numero_unidad'],
                'region_id'               => $data['region_id'],
                'titulo'                  => $data['titulo'],
                'tiene_educacion_fisica'  => $data['tiene_educacion_fisica'],
                'situacion_significativa' => $data['situacion_significativa'],
            ]);

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $ext = strtolower($file->extension());
                $filename = "{$plantilla->id}.{$ext}";

                $path = $file->storeAs(
                    (string) $plantilla->id,   // carpeta
                    $filename,                 // nombre
                    'unidadAprendizaje'        // disco
                );
                $plantilla->filename=$filename;
                $plantilla->save();
            }

            return response()->json([
                'ok'      => 1,
                'mensaje' => 'Plantilla de unidad registrada satisfactoriamente',
            ], 201);
        });
    }

    public function show(Request $request)
    {
        $item = PlantillaUnidad::with('region')->where('id', $request->id)->first();
        return $item;
    }

    public function update(UpdatePlantillaUnidadRequest $request)
    {
        $item = PlantillaUnidad::findOrFail($request->id);

        // === Actualizar campos base ===
        $item->grado                  = $request->grado;
        $item->numero_unidad          = $request->numero_unidad;
        $item->region_id              = $request->region_id;
        $item->titulo                 = $request->titulo;
        $item->tiene_educacion_fisica = $request->boolean('tiene_educacion_fisica');
        $item->situacion_significativa= $request->situacion_significativa;

        // === Si se envía un nuevo archivo ===
        if ($request->hasFile('archivo')) {
            // Eliminar el archivo anterior si existía
            if ($item->filename && Storage::disk('unidadAprendizaje')->exists("{$item->id}/{$item->filename}")) {
                Storage::disk('unidadAprendizaje')->delete("{$item->id}/{$item->filename}");
            }

            // Guardar el nuevo archivo
            $file = $request->file('archivo');
            $ext = strtolower($file->extension());
            $filename = "{$item->id}.{$ext}";

            $path = $file->storeAs(
                (string) $item->id,   // carpeta
                $filename,            // nombre
                'unidadAprendizaje'   // disco
            );

            $item->filename = $filename;
        }

        // === Guardar cambios ===
        $item->save();

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Plantilla de unidad modificada satisfactoriamente'
        ], 200);
    }

    public function destroy(Request $request)
    {
        $item = PlantillaUnidad::findOrFail($request->id);


        if ($item->filename && Storage::disk('unidadAprendizaje')->exists("{$item->id}/{$item->filename}")) {
            Storage::disk('unidadAprendizaje')->delete("{$item->id}/{$item->filename}");
        }

        if (Storage::disk('unidadAprendizaje')->exists("{$item->id}")) {
            Storage::disk('unidadAprendizaje')->deleteDirectory("{$item->id}");
        }

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

        return PlantillaUnidad::with([
            'region'
        ])
        ->whereRaw('UPPER(CAST(grado AS CHAR)) LIKE ?', ['%'.$buscar.'%'])
        ->orderBy('grado')
        ->paginate($paginacion);
    }
    public function obtenerAreasConSessiones(Request $request) {
        return PlantillaUnidad::with([
            'areas.sessiones' // Carga las sesiones de cada área
        ])->where('id', $request->id)->first();
    }

    public function sessionStore(StoreSessionesRequest $request)
    {
        $data = $request->validated();
        return DB::transaction(function () use ($request, $data) {
            $areaplantilla = AreaPlantilla::firstOrCreate([
                'plantilla_unidad_id' => $data['plantilla_unidad_id'],
                'area_id'             => $data['area_id'],
            ]);

            $sesion = SesionAprendizaje::create([
                'area_plantilla_id'   => $areaplantilla->id,
                'orden'               => $data['orden'],
                'titulo'              => $data['titulo'],
                'genero'              => $data['genero'],
            ]);

            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $ext = strtolower($file->extension());
                $filename = "{$data['plantilla_unidad_id']}_{$data['area_id']}_{$sesion->id}.{$ext}";

                $path = $file->storeAs(
                    (string) $data['plantilla_unidad_id'],   // carpeta
                    $filename,                 // nombre
                    'unidadAprendizaje'        // disco
                );
            }

            return response()->json([
                'ok'      => 1,
                'mensaje' => 'Plantilla de unidad registrada satisfactoriamente',
            ], 201);
        });
    }
    public function cargarSessiones(Request $request)
    {
        return AreaPlantilla::where([
            'plantilla_unidad_id' => $request->plantilla_unidad_id,
            'area_id'             => $request->area_id,
        ])->with('sessiones')->first();
    }
    public function eliminarSession(Request $request)
    {
        $sesion = SesionAprendizaje::findOrFail($request->id);

        $areaPlantilla = AreaPlantilla::findOrFail($sesion->area_plantilla_id);

        return DB::transaction(function () use ($sesion, $areaPlantilla) {

            // carpeta = plantilla_unidad_id
            $dir = (string) $areaPlantilla->plantilla_unidad_id;

            // prefijo del nombre según tu convención de guardado
            $prefix = "{$areaPlantilla->plantilla_unidad_id}_{$areaPlantilla->area_id}_{$sesion->id}";

            $disk = Storage::disk('unidadAprendizaje');

            // si existe la carpeta, listamos y eliminamos archivos que empiecen con el prefijo
            if ($disk->exists($dir)) {
                foreach ($disk->files($dir) as $path) {
                    // $path viene como "carpeta/archivo.ext"
                    if (Str::startsWith($path, $dir . '/' . $prefix)) {
                        $disk->delete($path);
                    }
                }
            }

            // eliminamos el registro
            $sesion->delete();

            return response()->json([
                'ok'      => 1,
                'mensaje' => 'Sesión eliminada satisfactoriamente',
            ], 200);
        });
    }
}
