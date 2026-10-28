<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        /*
         * Pastikan ValidationException selalu mengembalikan JSON
         * saat request berasal dari API (bukan redirect HTML).
         * Ini penting agar Postman mendapat response 422 dalam format JSON.
         */
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal. Periksa kembali data yang dikirim.',
                    'data'    => $e->errors(),
                ], 422); // HTTP 422 Unprocessable Entity
            }
        });
    })->create();
