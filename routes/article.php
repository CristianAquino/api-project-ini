<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::controller(ArticleController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{article}', 'show');
    Route::post('/', 'store');
    Route::put('/{article}', 'update');
    Route::delete('/{article}', 'destroy');
});
