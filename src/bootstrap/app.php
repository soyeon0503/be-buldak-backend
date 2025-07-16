<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',       
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $m) {

        // 글로벌 미들웨어
        $m->use([
            App\Http\Middleware\TrustProxies::class,
            Illuminate\Http\Middleware\HandleCors::class,
            Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
            Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        // web 그룹 (세션 + CSRF + Sanctum)
        $m->prependToGroup('web', [
            App\Http\Middleware\EncryptCookies::class,
            Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            Illuminate\Session\Middleware\StartSession::class,
            Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    })

    // ─────────── EXCEPTION HANDLER ─────────
    ->withExceptions(function (Exceptions $e) {
        //
    })

    ->create();