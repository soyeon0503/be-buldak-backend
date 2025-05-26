<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IngredientController;

Route::prefix('auth')->middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('auth')->middleware(['auth:sanctum', 'web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'register']);

    Route::middleware(['auth:sanctum', 'web'])->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('{id}', [UserController::class, 'show']);
        Route::patch('{id}', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'destroy']);
    });
});

Route::post('/password/forgot', [AuthController::class, 'passwordResetRequest']);
Route::post('/password/reset', [AuthController::class, 'passwordReset']);

Route::prefix('ingredient')->group(function () {
    Route::get('/', [IngredientController::class, 'index']);
    Route::get('{id}', [IngredientController::class, 'show']);
    Route::patch('{id}', [IngredientController::class, 'update']);
    Route::delete('{id}', [IngredientController::class, 'destroy']);
});