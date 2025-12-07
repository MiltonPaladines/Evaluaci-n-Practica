<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlataformaController;
use App\Http\Controllers\Api\GeneroController;
use App\Http\Controllers\Api\JuegoController;


//Rutas API 
Route::apiResource('plataformas', PlataformaController::class);
Route::apiResource('generos', GeneroController::class);
Route::apiResource('juegos', JuegoController::class);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
