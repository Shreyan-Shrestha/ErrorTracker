<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestData = [
            'method' => $request->method(),
            'url'    => $request->fullUrl(),
            'ip'     => $request->ip(),
            'headers'=> $this->sanitizeHeaders($request->headers->all()),
            'body'   => $request->all(),
        ];

        Log::info('API Request', $requestData);

        try {
            $response = $next($request);
            if(str_contains($response->headers->get('Content-type', ''), 'text/html')){
                Log::info('Returned a Webpage Response');
                return $response;
            }
            $responseData = [
                'status'  => $response->getStatusCode(),
                'content' => $this->safeJsonDecode($response->getContent()),
            ];
            Log::info('API Response', $responseData);

            return $response;
        } catch (Throwable $e) {
            Log::error('API Exception', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            throw $e; 
        }
    }

    private function safeJsonDecode(mixed $content)
    {
        $decoded = json_decode($content, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : $content;
    }

    private function sanitizeHeaders(array $headers) : array
    {
        $sensitiveHeaders = [
            'authorization',
            'cookie',
            'x-csrf-token',
            'x-xsrf-token',
            'postman-token',
        ];

        return array_diff_key($headers, array_flip($sensitiveHeaders));
    }
}
