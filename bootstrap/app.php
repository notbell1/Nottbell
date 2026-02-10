<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Gunakan fungsi closure untuk redirect agar lebih stabil di production
        $middleware->redirectGuestsTo(fn () => route('login'));
        $middleware->redirectUsersTo(fn () => '/admin');

        // Tambahkan ini jika kamu mengalami masalah Session/Cookie di Vercel
        $middleware->validateCsrfTokens(except: [
            // tambahkan rute yang perlu bypass CSRF jika ada (misal callback API)
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
