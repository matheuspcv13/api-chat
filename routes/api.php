<?php

use App\Http\Controllers\InformacoesUsuarioController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Middleware\CheckEmailVerified;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum', CheckEmailVerified::class)->group(function () {
    Route::put('/info', [\App\Http\Controllers\InformacoesUsuarioController::class, 'update']);
    Route::apiResource('info', \App\Http\Controllers\InformacoesUsuarioController::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

Route::get('/email-already-verified', function () {
    return view('email');
})->name('email');

Route::post('email/verification-notification', [AuthController::class, 'sendVerificationEmail']);

Route::get('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
    ->middleware(['auth:sanctum', 'signed'])
    ->name('verification.verify');

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);