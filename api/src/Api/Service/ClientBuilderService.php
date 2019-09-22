<?php

namespace App\Api\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientBuilderService
{
    /**
     * @return HttpClientInterface
     */
    public function getClient(): HttpClientInterface
    {
        return HttpClient::create();
    }
}
