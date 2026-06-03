<?php

use App\Helpers\ApiResponse;
use App\Http\Middleware\AddTraceIdMiddleware;
use App\Http\Middleware\LogApiRequests;
use App\Http\Middleware\UserAuthentication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'login' => UserAuthentication::class,
        ]);
        $middleware->append(AddTraceIdMiddleware::class);
        $middleware->append(LogApiRequests::class);
        $middleware->throttleApi('api');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ModelNotFoundException $err, Request $req) {
            Log::error('Error!', [
                'message' => 'Model not found',
                'data'    => $req->all(),
                'model'   => $err->getModel(),
                'error_message' => $err->getMessage(),
            ]);

            $error = [
                'message' => $err->getMessage(),
                'code' => 404,
                'trace' => Context::get('trace_id')
            ];

            return ApiResponse::error('Model not found', 404, $error);
        });
        $exceptions->render(function (NotFoundHttpException $err, Request $req) {
            Log::error('NotFoundHttpException has occured!', [
                'message' => $err->getMessage(),
                'status' => 404,
                'line' => $err->getLine(),
                'trace' => $err->getTraceAsString(),
            ]);

            $error = [
                'message' => $err->getMessage(),
                'code' => 404,
                'trace_id' => Context::get('trace_id'),
                'timestamp' => now(),
            ];

            return ApiResponse::error('Resource not found', 404, $error);
        });
        $exceptions->render(function (Request $req, Throwable $e) {
            if ($e instanceof TypeError || $e instanceof InvalidArgumentException) {
                $error = [
                    'message' => 'Check the request and try again',
                    'code' => '400',
                    'trace' => Context::get('$trace_id'),
                    'url' => $req->getUri(),
                ];
                return ApiResponse::error('Invalid argument provided', 400, $error);
            }
            
            return parent::render($req, $e);
        });
    })->create();
