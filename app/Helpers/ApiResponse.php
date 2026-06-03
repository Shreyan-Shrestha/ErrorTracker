<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse{

    public static function success( string $message = "success",int $code = 200, array $data) : JsonResponse
    {
        return response()->json([
            'success' => 'true',
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ]);
    }

    public static function error(string $message = "error", int $code = 500, array $error) : JsonResponse
    {
        return response()->json([
            'success' => 'false',
            'message' => $message,
            'error' => $error
        ], $code);
    }

}