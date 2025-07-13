<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/docs.yaml', function () {
    return response()->file(storage_path('api-docs/swagger_document.yaml'), [
        'Content-Type' => 'application/yaml'
    ]);
});

// 비밀번호 재설정 요청
Route::get('password/reset/{token}', function ($token) {
    $email = request('email');
    $frontendUrl = "http://localhost:3000/password-reset?token={$token}&email={$email}";
    return redirect($frontendUrl);
})->name('password.reset');
