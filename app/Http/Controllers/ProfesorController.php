<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profesor\StoreProfesorRequest;
use App\Http\Requests\Profesor\UpdateProfesorRequest;
use App\Models\Persona;
use App\Models\Profesor;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfesorController extends Controller
{
    public function store(StoreProfesorRequest $request){
        $persona = Persona::firstOrcreate([
            'dni'           => $request->dni,
            ],[
            'ape_pat'       => $request->apepat,
            'ape_mat'       => $request->apemat,
            'primernombre'  => $request->primernombre,
            'otrosnombres'  => $request->otrosnombres,
            'celular'       => $request->celular,
        ]);
        $profesor = Profesor::create([
            'persona_id'                => $persona->id,
            'institucion_educativa_id'  => $request->institucion_educativa_id,
        ]);
        $role_id = Rol::where('nombre', 'PROFESOR')->value('id'); //rol profesor
        $usuario = User::create([
            'name'          => $request->dni,
            'dni'           => $request->dni,
            'password'      => Hash::make($request->dni),
            'role_id'       => $role_id,
            'es_activo'     => 1,
        ]);
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Profesor Registrado satisfactoriamente'
        ],200);
    }
    public function update(UpdateProfesorRequest $request){
        $profesor = Profesor::with('persona')->where('id', $request->id)->first();

        DB::transaction(function() use ($request, $profesor) {
            // Guarda el DNI previo para localizar al usuario existente
            $oldDni = $profesor->persona->dni;

            // 1) Actualizar Persona
            $profesor->persona->update([
                'dni'          => $request->dni,
                'ape_pat'      => $request->apepat,
                'ape_mat'      => $request->apemat,
                'primernombre' => $request->primernombre,
                'otrosnombres' => $request->otrosnombres,
                'celular'      => $request->celular,
            ]);

            // 2) Actualizar Profesor
            $profesor->update([
                'institucion_educativa_id' => $request->institucion_educativa_id,
            ]);

            // 3) Sincronizar/crear Usuario (mismo criterio que en store)
            $roleId = Rol::where('nombre', 'PROFESOR')->value('id');

            $user = User::where('dni', $oldDni)->first();
            if (!$user) {
                // Si no existía, lo creamos como en store
                User::create([
                    'name'      => $request->dni,
                    'dni'       => $request->dni,
                    'password'  => Hash::make($request->dni),
                    'role_id'   => $roleId,
                    'es_activo' => 1,
                ]);
            } else {
                // Actualizamos DNI/username; password se mantiene salvo que pidan reset
                $user->fill([
                    'name'    => $request->dni,
                    'dni'     => $request->dni,
                    'role_id' => $roleId,
                ])->save();

                if ($request->boolean('reset_password_to_dni')) {
                    $user->password = Hash::make($request->dni);
                    $user->save();
                }
            }
        });

        return response()->json([
            'ok'      => 1,
            'mensaje' => 'Profesor actualizado satisfactoriamente',
        ], 200);
    }
    public function show(Request $request){
        $user = Profesor::with(
            'persona:dni,ape_pat,ape_mat,primernombre,otrosnombres,celular'
            )->where('id', $request->id)->first();
        return $user;
    }

    public function listar(Request $request)
    {  
        $buscar = mb_strtoupper($request->buscar);
        $paginacion = $request->paginacion;
        $profesores = Profesor::with(['persona', 'institucion_educativa']);
        return $profesores->paginate($paginacion);
    }
    public function destroy(Request $request){
        $profesor = Profesor::where('id', $request->id)->first();

        $profesor->delete();
        return response()->json([
            'ok' => 1,
            'mensaje' => 'Usuario eliminado satisfactoriamente'
        ],200);
    }
    public function todos(){
        return User::get();
    }
}
