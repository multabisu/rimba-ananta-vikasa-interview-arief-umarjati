<?php

namespace App\Traits;

trait ApiResponse
{

    protected function successResponse($data, string $message = null, int $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    protected function errorResponse(string $message, int $statusCode)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => null
        ], $statusCode);
    }
}
