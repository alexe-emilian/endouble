<?php

namespace App\Api\Service;

use App\Api\Exception\RequestException;
use Symfony\Component\HttpFoundation\Request;

class ResponseMetadataService
{
    /**
     * @param array $parameters
     * @return array
     * @throws RequestException
     */
    public function getMeta(array $parameters): array
    {
        try {
            return [
                "request" => $parameters,
                "timestamp" => (new \DateTime()),
            ];
        } catch (\Throwable $exception) {
            throw new RequestException(
                "Could not build metadata for response"
            );
        }
    }

    /**
     * @param array $parameters
     * @return array
     */
    public function getErrorMeta(array $parameters): array
    {
        return [
            "request" => $parameters,
        ];
    }
}
