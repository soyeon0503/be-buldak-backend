<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\SideMenuController;
use App\Http\Controllers\Api\TierController;
use App\Http\Controllers\Api\ReceiptController;
use App\Http\Controllers\Api\ReceiptSaveController;
use App\Http\Controllers\Api\ReceiptEatController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::prefix('auth')->middleware(['auth:sanctum', 'web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

/*
|--------------------------------------------------------------------------
| Password Reset
|--------------------------------------------------------------------------
*/
Route::post('/password/forgot', [AuthController::class, 'passwordResetRequest']);
Route::post('/password/reset', [AuthController::class, 'passwordReset']);

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'register']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Ingredients
|--------------------------------------------------------------------------
*/
Route::prefix('ingredient')->group(function () {
    Route::get('/', [IngredientController::class, 'index']);
    Route::get('{id}', [IngredientController::class, 'show']);
    Route::post('/', [IngredientController::class, 'register']);
    Route::put('{id}', [IngredientController::class, 'update']);
    Route::delete('{id}', [IngredientController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Side Menus
|--------------------------------------------------------------------------
*/
Route::prefix('side-menu')->group(function () {
    Route::get('/', [SideMenuController::class, 'index']);
    Route::get('{id}', [SideMenuController::class, 'show']);
    Route::post('/', [SideMenuController::class, 'register']);
    Route::put('{id}', [SideMenuController::class, 'update']);
    Route::delete('{id}', [SideMenuController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Tier
|--------------------------------------------------------------------------
*/
Route::prefix('tier')->group(function () {
    Route::get('/', [TierController::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| Receipt
|--------------------------------------------------------------------------
*/
Route::prefix('recipe')->group(function () {
    Route::get('/', [ReceiptController::class, 'index']);
    Route::get('/{recipe}', [ReceiptController::class, 'show']);
    Route::post('/{user}', [ReceiptController::class, 'register']);
    Route::put('/{recipe}/{user}', [ReceiptController::class, 'update']);
    Route::delete('/{recipe}', [ReceiptController::class, 'destroy']);
    // 조회수 증가
    Route::patch('/{recipe}/view', [ReceiptController::class, 'incrementViews']);
    // 레시피 작성한 유저 조회
    Route::get('/users/{user}', [ReceiptController::class, 'userReceipts']);
});

Route::middleware('auth:sanctum')->group(function () {
    // 저장한 레시피
    Route::patch('/recipe/{recipe}/save', [ReceiptSaveController::class, 'toggleSave']);
    Route::get('/users/{user}/saved-recipe', [ReceiptSaveController::class, 'index']);

    // 먹어본 레시피
    Route::patch('/recipe/{recipe}/eat', [ReceiptEatController::class, 'toggleEat']);
    Route::get('/users/{user}/eaten-recipe', [ReceiptEatController::class, 'index']);
});
