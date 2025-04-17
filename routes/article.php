<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index']);
Route::get('/{article}', [ArticleController::class, 'show']);
Route::get('/{article}', [ArticleController::class, 'update']);
Route::get('/{article}', [ArticleController::class, 'destroy']);
