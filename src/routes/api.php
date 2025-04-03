<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\api\UserController;

Route::get('/auth/csrf-token', function (Request $request) {
    Session::start();

    $token = csrf_token();

    return Response::json(['token' => $token]);
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/api/auth/user', function (Request $request) {
        return Response::json($request->user());
    });

    Route::post('/api/auth/logout', function (Request $request) {
        $request->user()->tokens()->delete();

        return Response::json(['message' => '로그아웃되었습니다']);
    });
});

Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'register']);
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::patch('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});


Route::get('/ping', fn () => ['pong']);