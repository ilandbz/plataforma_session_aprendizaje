<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::post('/login',[LoginController::class,'login']);






require __DIR__."/entidades.php";
Route::get('/{path}',function(){   return view('app'); })->where('path','.*');