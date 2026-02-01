<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login')
        ->withoutMiddleware([
            'auth_cookie',
            'jwt_valid'
        ]);
    Route::post('/logout', 'logout')
        ->withoutMiddleware([
            'auth_cookie',
            'jwt_valid'
        ]);
});
