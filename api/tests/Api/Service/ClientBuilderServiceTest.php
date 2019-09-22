<?php

namespace App\Tests\Api\Service;

use App\Api\Service\ClientBuilderService;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientBuilderServiceTest extends TestCase
{
    public function testClientIsReturned(): void
    {
        $client = new ClientBuilderService();

        $this->assertInstanceOf(HttpClientInterface::class, $client->getClient());
    }
}
