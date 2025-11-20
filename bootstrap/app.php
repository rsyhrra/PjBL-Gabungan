<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException; // Tambahkan ini
use Illuminate\Http\Request; // Tambahkan ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // LOGIKA REDIRECT:
        // Jika belum login dan mencoba masuk halaman admin, arahkan ke admin.login
        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('login'); // Default (jika ada user biasa)
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();