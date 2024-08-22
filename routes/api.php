<?php

use App\Http\Controllers\InformacoesUsuarioController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
	Route::put('/info', [\App\Http\Controllers\InformacoesUsuarioController::class, 'update']);
    Route::apiResource('info', \App\Http\Controllers\InformacoesUsuarioController::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);