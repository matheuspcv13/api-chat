<?php

use App\Events\ConversationUpdated;
use App\Http\Controllers\InformacoesUsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FriendshipController;
use App\Http\Middleware\CheckEmailVerified;
use App\Events\FriendRequestEvent;
use App\Events\MyEvent;
use Illuminate\Broadcasting\BroadcastEvent;

Route::post('/send-message', function (Request $request) {
    $message = $request->input('message');
    
    // event(new FriendRequestEvent($message));
    event(new ConversationUpdated(2));

    return response()->json(['status' => 'Message sent!']);
});

Route::get('/user', function (Request $request) {
    return response()->json($request->user());
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum', CheckEmailVerified::class)->group(function () {
    Route::get('/busca-usuario', [\App\Http\Controllers\InformacoesUsuarioController::class, 'findUsers']);
    Route::apiResource('info', \App\Http\Controllers\InformacoesUsuarioController::class);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::apiResource('conversas', ConversasController::class);
    Route::apiResource('friendship', FriendshipController::class);
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