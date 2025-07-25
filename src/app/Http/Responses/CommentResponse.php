<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;

class CommentResponse implements Responsable
{
    public function __construct(
        private mixed $data,
        private int $status = HttpResponse::HTTP_OK,
    ) {}

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'data' => $this->data,
        ], $this->status);
    }
}
