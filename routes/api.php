<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(base_path('routes/auth.php'));
Route::prefix('article')->group(base_path('routes/article.php'));
Route::prefix('comment')->group(base_path('routes/comment.php'));
