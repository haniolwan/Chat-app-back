<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function success_response(array $message, array $data = [], $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function fail_response(array $message, $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => [],
        ], $code);
    }

    public function error_response(array $message, $code = 500): JsonResponse
    {
        // todo: add log for error
        return self::fail_response($message, $code);
    }
}
