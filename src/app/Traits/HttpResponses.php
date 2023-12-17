<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'Запрос был успешно выполнен.',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function error($data, $message = null, $code): JsonResponse
    {
        return response()->json([
            'status' => 'Произошла ошибка.',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
