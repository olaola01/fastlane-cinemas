<?php

namespace App\Traits;

use App\Enum\ApiStatusMessageResponse;
use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    public function successCall($data = [], $status = ApiStatusMessageResponse::SUCCESS, $status_code = 200): JsonResponse
    {
        $response = ['status_code' => $status_code, 'status' => $status, 'data' => $data];

        return response()->json($response, $status_code);
    }

    public function badCall($status_code, $status, $error_message): JsonResponse
    {
        $response = ["status_code" => $status_code, "status" => $status, "error" => $error_message];

        return response()->json($response, $status_code);
    }
}
