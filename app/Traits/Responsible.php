<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Responsible
{
    public function apiResource(
        mixed $body = null,
        string $message = 'Success',
        bool $status = true,
        int $customCode = 200,
        int $httpCode = 200
    ): JsonResponse {
        foreach($body as $key => $value){
            $body[$key]=$value;
        }
        return response()->json([
            'body' => (object)$body,
            'message' => $message,
            'status' => $status,
            'custom_code' => $customCode
        ], $httpCode);
    }

    public function apiPaginated(
        $paginator,
        string $message = 'Success',
        bool $status = true,
        int $customCode = 200,
        int $httpCode = 200
    ): JsonResponse {
        return response()->json([
            'body' =>[
                'data'=> $paginator->items(),
                'pagination' => [
                    'total' => $paginator->total(),
                    'per_page' => $paginator->perPage(),
                    'current_page' => $paginator->currentPage(),
                    'last_page' => $paginator->lastPage(),
                ]
            ],
            'message' => $message,
            'status' => $status,
            'custom_code' => $customCode
        ], $httpCode);
    }


}
