<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::controller(ArticleController::class)->group(function () {
    Route::get('/', 'index')
        ->withoutMiddleware([
            'auth_cookie',
            'jwt_valid'
        ]);
    Route::post('/', 'store');
    Route::get('/{article}', 'show');
    Route::put('/{article}', 'update');
    Route::delete('/{article}', 'destroy');
});
