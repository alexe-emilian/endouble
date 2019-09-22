<?php

namespace App\Api\Response;

class ApiErrorResponse
{
    /**
     * @var array
     */
    private $meta;

    /**
     * @var array
     */
    private $errors;

    /**
     * ApiErrorResponse constructor.
     * @param array $meta
     * @param array $errors
     */
    public function __construct(array $meta, array $errors)
    {
        $this->meta = $meta;
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
