<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\GrupoMenuController;
use App\Http\Controllers\InstitucionEducativaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoUnidadAprendizajeController;
use App\Http\Controllers\UnidadAprendizajeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//ROLE
Route::group(['prefix' => 'rol', 'middleware' => 'auth'], function () {
    Route::get('todos', [RolController::class, 'todos']);
    Route::get('mostrar', [RolController::class, 'show']);
    Route::post('actualizar', [RolController::class, 'update']);
    Route::post('eliminar', [RolController::class, 'destroy']);
    Route::post('guardar', [RolController::class, 'store']);
    Route::get('listar', [RolController::class, 'listar']);
    Route::get('menu-roles',[RolController::class,'mostrarRoleMenus']);
    Route::get('mostrar-menus',[RolController::class,'mostrarMenus']);
    Route::post('menu-role-guardar',[RolController::class,'guardarRoleMenu']);
});


Route::group(['prefix' => 'usuario', 'middleware' => 'auth'], function () {
    Route::get('usuario-session-data',[UserController::class,'mostrarDatoUsuario']);
    Route::post('reset-password',[UserController::class,'resetclave']);
    Route::get('listar-habilitados',[UserController::class,'habilitados']);
    Route::get('listar-inactivos',[UserController::class,'inactivos']);
    Route::get('listar-todos',[UserController::class,'todos']);
    Route::get('mostrar', [UserController::class, 'show']);
    Route::post('actualizar', [UserController::class, 'update']);
    Route::post('eliminar', [UserController::class, 'destroy']);
    Route::post('guardar', [UserController::class, 'store']);
    Route::get('cambiar-estado',[UserController::class,'cambiarEstado']);
    Route::post('cambiar-clave',[UserController::class,'cambiarclaveperfil']);
    Route::post('eliminar-role',[UserController::class,'eliminarRole']);
    Route::post('eliminar-agencia',[UserController::class,'eliminarAgencia']);
    Route::post('agregar-role',[UserController::class,'agregarRole']);
    Route::post('agregar-agencia',[UserController::class,'agregarAgencia']);
    Route::get('roles-disponibles',[UserController::class,'rolesDisponibles']);
    Route::get('agencias-disponibles',[UserController::class,'agenciasDisponibles']);
    Route::get('users-tipo-agencia',[UserController::class,'obtenerPorTipo']);
    Route::post('cambiar-imagen',[UserController::class,'cambiarImagen']);
    Route::get('obtener-usuarios-operaciones',[UserController::class,'obtenerUsuariosOperadores']);
});
Route::group(['prefix' => 'menu', 'middleware' => 'auth'], function () {
    Route::get('todos', [MenuController::class, 'todos']);
    Route::get('mostrar', [MenuController::class, 'show']);
    Route::post('actualizar', [MenuController::class, 'update']);
    Route::post('eliminar', [MenuController::class, 'destroy']);
    Route::post('guardar', [MenuController::class, 'store']);
    Route::get('listar', [MenuController::class, 'listar']);
    Route::get('obtener-menus-role',[UserController::class,'obtenerMenusPorRole']);
});


Route::group(['prefix' => 'profesor', 'middleware' => 'auth'], function () {
    Route::post('guardar', [ProfesorController::class, 'store']);
    Route::get('mostrar', [ProfesorController::class, 'show']);
    Route::post('actualizar', [ProfesorController::class, 'update']);
    Route::get('listar', [ProfesorController::class, 'listar']);
    Route::post('eliminar', [ProfesorController::class, 'destroy']);
    Route::get('todos', [ProfesorController::class, 'todos']);
});



Route::group(['prefix' => 'grupo-menu', 'middleware' => 'auth'], function () {
    Route::get('todos', [GrupoMenuController::class, 'todos']);
    Route::get('mostrar', [GrupoMenuController::class, 'show']);
    Route::post('actualizar', [GrupoMenuController::class, 'update']);
    Route::post('eliminar', [GrupoMenuController::class, 'destroy']);
    Route::post('guardar', [GrupoMenuController::class, 'store']);
    Route::get('listar', [GrupoMenuController::class, 'listar']);
});


Route::group(['prefix' => 'area', 'middleware' => 'auth'], function () {
    Route::get('todos', [AreaController::class, 'all']);
    Route::get('mostrar', [AreaController::class, 'show']);
    Route::post('actualizar', [AreaController::class, 'update']);
    Route::post('eliminar', [AreaController::class, 'destroy']);
    Route::post('guardar', [AreaController::class, 'store']);
    Route::get('listar', [AreaController::class, 'listar']);
});

Route::group(['prefix' => 'tipo-unidad-aprendizaje', 'middleware' => 'auth'], function () {
    Route::get('todos', [TipoUnidadAprendizajeController::class, 'all']);
    Route::get('mostrar', [TipoUnidadAprendizajeController::class, 'show']);
    Route::post('actualizar', [TipoUnidadAprendizajeController::class, 'update']);
    Route::post('eliminar', [TipoUnidadAprendizajeController::class, 'destroy']);
    Route::post('guardar', [TipoUnidadAprendizajeController::class, 'store']);
    Route::get('listar', [TipoUnidadAprendizajeController::class, 'listar']);
});

Route::group(['prefix' => 'institucion-educativa', 'middleware' => 'auth'], function () {
    Route::get('todos', [InstitucionEducativaController::class, 'all']);
    Route::get('mostrar', [InstitucionEducativaController::class, 'show']);
    Route::post('actualizar', [InstitucionEducativaController::class, 'update']);
    Route::post('eliminar', [InstitucionEducativaController::class, 'destroy']);
    Route::post('guardar', [InstitucionEducativaController::class, 'store']);
    Route::get('listar', [InstitucionEducativaController::class, 'listar']);
});


Route::group(['prefix' => 'unidad-aprendizaje', 'middleware' => 'auth'], function () {
    Route::get('todos', [UnidadAprendizajeController::class, 'all']);
    Route::get('mostrar', [UnidadAprendizajeController::class, 'show']);
    Route::post('actualizar', [UnidadAprendizajeController::class, 'update']);
    Route::post('eliminar', [UnidadAprendizajeController::class, 'destroy']);
    Route::post('guardar', [UnidadAprendizajeController::class, 'store']);
    Route::get('listar', [UnidadAprendizajeController::class, 'listar']);
    Route::post('generar-pdf', [UnidadAprendizajeController::class, 'generarPdf']);
});