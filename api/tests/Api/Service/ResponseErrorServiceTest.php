<?php

namespace App\Tests\Api\Service;

use App\Api\Service\ResponseErrorService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ResponseErrorServiceTest extends TestCase
{
    public function testErrorResponseIsGeneratedSuccessfully(): void
    {
        $exception = $this->createMock(\Throwable::class);

        $service = new ResponseErrorService();
        $result = $service->getErrors($exception);

        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals($result['status'], Response::HTTP_BAD_REQUEST);
    }
}
