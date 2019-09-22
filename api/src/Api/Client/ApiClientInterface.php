<?php

namespace App\Api\Client;

use App\Api\Exception\RequestException;

interface ApiClientInterface
{
    /**
     * @param array $parameters
     * @throws RequestException
     */
    public function list(array $parameters);
}
