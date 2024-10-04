<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    // success response method
    public function sendResponse(mixed $data = null, ?string $message = null, int $status = 200, array $meta = []) : JsonResponse
    {
        $response = ['status' => 'success', 'success' => true, 'statusCode' => $status];
        if ($data) {
            $response['data'] = $data;
        }

        if ( ! empty($meta)) {
            foreach ($meta as $key => $value) {
                $response[$key] = $value;
            }
        }

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $status);
    }

    // return error response
    public function sendError($error, $errorMessages = [], int $status = 500): JsonResponse
    {
        $response = [
            'status' => 'error',
            'success' => false,
            'statusCode' => $status,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $status);
    }
}
