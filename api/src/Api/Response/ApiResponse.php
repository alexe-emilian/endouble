<?php

namespace App\Api\Response;

class ApiResponse
{
    /**
     * @var array
     */
    private $meta;

    /**
     * @var mixed
     */
    private $data;

    /**
     * ApiResponse constructor.
     * @param array $meta
     * @param mixed $data
     */
    public function __construct(array $meta, $data)
    {
        $this->meta = $meta;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
