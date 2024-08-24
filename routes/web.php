<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('/reviews', [ReviewController::class, 'store']);
Route::get('/reviews', [ReviewController::class, 'index']);

// Ответы
Route::post('/reviews/{review}/replies', [ReplyController::class, 'store']);


require __DIR__.'/auth.php';
