<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [CommentController::class, 'index']);
Route::get('/{comment}', [CommentController::class, 'show']);
Route::get('/{comment}', [CommentController::class, 'update']);
Route::get('/{comment}', [CommentController::class, 'destroy']);
