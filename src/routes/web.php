<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// swagger
Route::get('/api/docs.json', function () {
    return response()->file(storage_path('api-docs/swagger.json'));
});

// 비밀번호 재설정 요청
Route::get('password/reset/{token}', function ($token) {
    $email = request('email');
    $frontendUrl = "http://localhost:3000/password-reset?token={$token}&email={$email}";
    return redirect($frontendUrl);
})->name('password.reset');
