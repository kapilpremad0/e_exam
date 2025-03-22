<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
       
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            if ($request->is('api/*')) {
                
                if ($exception instanceof NotFoundHttpException) {
                    return response()->json(['message' => 'API not found.'], 404);
                }

                if ($exception instanceof ValidationException) {

                    $formattedErrors = collect($exception->errors())->mapWithKeys(function ($messages, $field) {
                        return [$field => $messages[0]]; // Take the first error message per field
                    });
                    
                    return response()->json([
                        'message' => 'Validation failed.',
                        'errors'  => $formattedErrors,
                    ], 422);
                }

                return response()->json([
                    'message' => $exception->getMessage() ?: 'Something went wrong',
                ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
            }

            if ($request->is('admin/*')) {
                // abort(404);
            }

            // Default error handling for non-API routes
            return null;
        });
    })->create();
