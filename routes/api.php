<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\AuthController;




Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get( '/user',function (Request $request) {
        return $request->user();
});

Route::prefix('admin')
->name('api.')
->group (function () {
       Route::apiResource('posts', PostController::class);
       Route::apiResource('category', CategoryController::class);

       Route::post('/register', [AuthController::class, 'register']);
       Route::post('/login', [AuthController::class, 'login']);
});

//Route::apiResource('posts', PostController::class);