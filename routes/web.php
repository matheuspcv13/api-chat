<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebAuthController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

Route::post('/login', [WebAuthController::class, 'login'])->name('login');

Route::get('/email-verificado', function () {
    return view('email');
})->name('email.verificado');