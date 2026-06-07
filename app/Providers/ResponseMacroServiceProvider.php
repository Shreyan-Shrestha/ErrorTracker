<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro(
            'success',
            function (
                mixed $data,
                ?string $message = 'Request completed successfully',
                $status = 200
            ): JsonResponse {
                return Response::json([
                    'success' => 'true',
                    'message' =>  $message,
                    'data' => $data,
                ], $status, [
                    'Content-Type' => 'application/vnd.api+json'
                ]);
            }
        );

        Response::macro('error', function (mixed $errors = null, string $message = 'Error!', int $status = 400): JsonResponse {
            return Response::json([
                'success' => 'false',
                'message' => $message,
                'errors' => $errors,
            ], $status, [
                'Content-Type' => 'application/vnd.api+json',
            ]);
        });
    }
}
