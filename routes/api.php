<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(base_path('routes/auth.php'));
Route::prefix('article')->group(base_path('routes/article.php'));
Route::prefix('comment')->group(base_path('routes/comment.php'));
