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
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('web');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('web');
    Route::get('/user', [AuthController::class, 'me'])->middleware('web');

    Route::post('/password-reset/request', [AuthController::class, 'passwordResetRequest']);
    Route::post('/password-reset', [AuthController::class, 'passwordReset']);
});

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'register']);
    Route::patch('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Ingredients
|--------------------------------------------------------------------------
*/
Route::prefix('ingredients')->group(function () {
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
Route::prefix('side-menus')->group(function () {
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
Route::prefix('tiers')->group(function () {
    Route::get('/', [TierController::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| Receipt
|--------------------------------------------------------------------------
*/
Route::prefix('recipes')->group(function () {
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
    Route::patch('/recipes/{recipe}/save', [ReceiptSaveController::class, 'toggleSave']);
    Route::get('/users/{user}/saved-recipes', [ReceiptSaveController::class, 'index']);

    // 먹어본 레시피
    Route::patch('/recipes/{recipe}/eat', [ReceiptEatController::class, 'toggleEat']);
    Route::get('/users/{user}/eaten-recipes', [ReceiptEatController::class, 'index']);
});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'store']);           // 댓글 등록
        Route::put('{id}', [CommentController::class, 'update']);       // 댓글 수정
        Route::get('{id}', [CommentController::class, 'show']);         // 댓글 상세
        Route::delete('{id}', [CommentController::class, 'destroy']);   // 댓글 삭제
    });

    Route::get('/users/{userId}/comments', [CommentController::class, 'userComments']);       // 유저 댓글 목록
    Route::get('/recipes/{recipeId}/comments', [CommentController::class, 'recipeComments']); // 레시피 댓글 목록
});
