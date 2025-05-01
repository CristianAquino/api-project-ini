<?php

use Illuminate\Support\Facades\Route;

// auth routes
Route::prefix('auth')
    ->middleware([
        'auth_cookie',
        'jwt_valid'
    ])->group(base_path('routes/auth.php'));
// user routes
Route::prefix('user')
    ->middleware([
        'auth_cookie',
        'jwt_valid'
    ])
    ->group(base_path('routes/user.php'));
// articles routes
Route::prefix('articles')
    ->middleware([
        'auth_cookie',
        'jwt_valid'
    ])->group(base_path('routes/article.php'));
// comments routes
Route::prefix('comments')
    ->middleware([
        'auth_cookie',
        'jwt_valid'
    ])->group(base_path('routes/comment.php'));
