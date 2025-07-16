<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * 암호화에서 제외할 쿠키 이름들.
     *
     * @var array<int, string>
     */
    protected $except = [
        'XSRF-TOKEN',
    ];
}
