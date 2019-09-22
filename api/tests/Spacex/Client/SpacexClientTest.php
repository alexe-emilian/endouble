<?php

namespace App\Tests\Spacex\Client;

use App\Api\Exception\RequestException;
use App\Api\Service\ClientBuilderService;
use App\Spacex\Client\SpacexClient;
use App\Spacex\Service\ResponseBuilderService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class SpacexClientTest extends TestCase
{
    public function testExceptionIsThrownDuringHttpCall()
    {
        $clientBuilderService = $this->getClientBuilderForInvalidHttpCall();
        $responseBuilderService = $this->createMock(ResponseBuilderService::class);
        $serializer = $this->createMock(SerializerInterface::class);
        $client = new SpacexClient($clientBuilderService, $responseBuilderService, $serializer);

        $this->expectException(RequestException::class);

        $client->list([]);
    }

    public function testCallIsSuccessful()
    {
        $clientBuilderService = $this->getClientBuilderForValidHttpCall();
        $responseBuilderService = $this->createMock(ResponseBuilderService::class);
        $responseBuilderService->method('getResponse')->willReturn([]);
        $serializer = $this->createMock(SerializerInterface::class);
        $serializer->method('deserialize')->willReturn([]);
        $client = new SpacexClient($clientBuilderService, $responseBuilderService, $serializer);

        $result = $client->list([]);

        $this->assertIsArray($result);
    }

    private function getClientBuilderForInvalidHttpCall()
    {
        $exception = $this->createMock(\Throwable::class);
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->method('request')->willThrowException($exception);

        $clientBuilderService = $this->createMock(ClientBuilderService::class);
        $clientBuilderService->method('getClient')->willReturn($httpClient);

        return $clientBuilderService;
    }

    private function getClientBuilderForValidHttpCall()
    {
        $response = $this->createMock(ResponseInterface::class);
        $response->method('getContent')->willReturn('{}');
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->method('request')->willReturn($response);

        $clientBuilderService = $this->createMock(ClientBuilderService::class);
        $clientBuilderService->method('getClient')->willReturn($httpClient);

        return $clientBuilderService;
    }
}
