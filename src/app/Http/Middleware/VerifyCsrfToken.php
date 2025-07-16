<?php
namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * CSRF 검증을 제외할 URL 리스트
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/*', // API 요청은 CSRF 검증을 제외합니다.
    ];
    
}

