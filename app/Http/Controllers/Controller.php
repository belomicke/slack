<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function sendError(): JsonResponse
    {
        return response()->json([
            'success' => false
        ]);
    }

    public function sendResponse(array $data = [], string $message = ''): JsonResponse
    {
        $responseData = [
            'success' => true
        ];

        if (!empty($data)) {
            $responseData['data'] = $data;
        }

        if (strlen($message) > 0) {
            $responseData['message'] = $message;
        }

        return response()->json($responseData);
    }
}
