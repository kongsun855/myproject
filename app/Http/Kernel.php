<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // ... web middleware
        ],

        'api' => [
            // Laravel Sanctum's middleware for handling SPA/API stateful requests
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,

            // Rate limiting for API
            'throttle:api',

            // Route model binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    // ... rest of the file (routeMiddleware, middlewarePriority, etc.)
}