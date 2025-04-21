<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(base_path('routes/auth.php'));
Route::prefix('user')
    ->middleware([
        'auth_cookie',
        'jwt_valid'
    ])
    ->group(base_path('routes/user.php'));
Route::prefix('article')->group(base_path('routes/article.php'));
Route::prefix('comment')->group(base_path('routes/comment.php'));
