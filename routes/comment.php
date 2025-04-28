<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


Route::controller(CommentController::class)->group(function () {
    Route::get('/{article}', 'index');
    Route::get('/{article}/{comment}', 'show');
    Route::post('/{article}', 'store');
    Route::put('/{article}/{comment}', 'update');
    Route::delete('/{article}/{comment}', 'destroy');
});
