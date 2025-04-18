<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;


Route::controller(CommentController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{comment}', 'show');
    Route::post('/', 'store');
    Route::put('/{comment}', 'update');
    Route::delete('/{comment}', 'destroy');
});
