<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/me', 'me');
    // Route::post('/', 'store');
    // Route::put('/{article}', 'update');
    Route::delete('/', 'destroy');
});
