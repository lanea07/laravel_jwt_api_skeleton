<?php

use App\Http\Middleware\FormatApiResponse;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\ValidateActions;
use App\Http\Middleware\ValidateApiVersion;
use App\Exceptions\UnhandledExceptions;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'setLocale' => SetLocale::class,
            'jwt' => JwtMiddleware::class,
            'hasActions' => ValidateActions::class,
            'validateApiVersion' => ValidateApiVersion::class,
            'formatApiResponse' => FormatApiResponse::class
        ]);

        // Apply response formatting to all API routes
        $middleware->api(append: [
            FormatApiResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, $request) {
            // Only handle JSON requests for API routes
            if ($request->expectsJson() && preg_match('/^api\/(v\d+)\//', $request->path())) {
                $handler = new UnhandledExceptions(app());
                return $handler->handleApiException($request, $e);
            }
            return null; // Let default handler take over
        });
    })
    ->create();
