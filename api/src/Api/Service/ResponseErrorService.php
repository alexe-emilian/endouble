<?php

namespace App\Api\Service;

use Symfony\Component\HttpFoundation\Response;

class ResponseErrorService
{
    public function getErrors(\Throwable $exception): array
    {
        return [
            "status" => Response::HTTP_BAD_REQUEST,
            "message" => $exception->getMessage(),
        ];
    }
}
