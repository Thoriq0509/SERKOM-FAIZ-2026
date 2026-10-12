<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |------------------------------------------------------------------
        | Alias Middleware
        |------------------------------------------------------------------
        */
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);

        // User sudah login buka /login → ke dashboard
        $middleware->redirectUsersTo(fn () => route('admin.dashboard'));

        // User belum login buka halaman admin → ke halaman login
        $middleware->redirectGuestsTo(fn () => route('auth.login'));

    })
    ->withExceptions(function (Exceptions $exceptions): void {


        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );

    })->create();