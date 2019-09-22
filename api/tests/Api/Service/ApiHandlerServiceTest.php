<?php

namespace App\Tests\Api\Service;

use App\Api\Enum\SourceEnum;
use App\Api\Exception\RequestException;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Service\ApiHandlerService;
use PHPUnit\Framework\TestCase;

class ApiHandlerServiceTest extends TestCase
{
    public function testSourceIdDoesNotExist(): void
    {
        $handler = $this->createMock(ApiHandlerInterface::class);
        $service = new ApiHandlerService([$handler]);

        $this->expectException(RequestException::class);
        $service->handle([]);
    }

    public function testSourceCannotBeHandled(): void
    {
        $data = [
            'sourceId' => 'test',
        ];
        $handler = $this->createMock(ApiHandlerInterface::class);
        $handler->method('canHandle')->willReturn(false);
        $service = new ApiHandlerService([$handler]);

        $this->expectException(RequestException::class);
        $service->handle($data);
    }

    public function testRequestIsProcessed(): void
    {
        $data = [
            'sourceId' => SourceEnum::COMICS,
        ];
        $handler = $this->createMock(ApiHandlerInterface::class);
        $handler->method('canHandle')->willReturn(true);
        $handler->method('handle')->willReturn([]);
        $service = new ApiHandlerService([$handler]);

        $response = $service->handle($data);

        $this->assertIsArray($response);
    }
}
