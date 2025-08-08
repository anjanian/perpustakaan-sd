<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        using: function () {
            app()->router->aliasMiddleware(
                'role',
                \Spatie\Permission\Middleware\RoleMiddleware::class
            );
        }
    )

    ->withMiddleware(function ($middleware) {
        // Middleware global di sini
    })
    ->withExceptions()
    ->create();


return $app;
