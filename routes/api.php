<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
//
//Route::post('/reviews', [ReviewController::class, 'store']);
//Route::get('/reviews', [ReviewController::class, 'index']);
//
//// Ответы
//Route::post('/reviews/{review}/replies', [ReplyController::class, 'store']);
