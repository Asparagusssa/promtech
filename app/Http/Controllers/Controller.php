<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class Controller
{
    /**
     * Обрабатывает успешный ответ.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @return JsonResponse
     */
    protected function successResponse(mixed $data, int $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * Обрабатывает ошибку.
     *
     * @param  \Exception  $exception
     * @return JsonResponse
     */
    protected function errorResponse(\Throwable $exception, $code = null): JsonResponse
    {

        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
        ], $exception->getCode());
    }
}
