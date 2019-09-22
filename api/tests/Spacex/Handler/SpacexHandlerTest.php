<?php

namespace App\Tests\Spacex\Handler;

use App\Api\Client\ApiClientInterface;
use App\Api\Enum\SourceEnum;
use App\Api\Handler\ApiHandlerInterface;
use App\Spacex\Handler\SpacexHandler;
use PHPUnit\Framework\TestCase;

class SpacexHandlerTest extends TestCase
{
    /**
     * @var ApiClientInterface
     */
    private $client;

    /**
     * @var ApiHandlerInterface
     */
    private $handler;

    public function setUp()
    {
        $this->client = $this->createMock(ApiClientInterface::class);
        $this->handler = new SpacexHandler($this->client);
    }

    public function tearDown()
    {
        unset($this->client);
        unset($this->handler);
    }

    public function testRequestCannotBeHandled(): void
    {
        $request = [
            'sourceId' => 'test',
        ];
        $result = $this->handler->canHandle($request);

        $this->assertEquals(false, $result);
    }

    public function testRequestCanBeHandled()
    {
        $request = [
            'sourceId' => SourceEnum::SPACE,
        ];
        $result = $this->handler->canHandle($request);

        $this->assertEquals(true, $result);
    }

    public function testRequestIsHandled()
    {
        $this->client->method('list')->willReturn([]);

        $request = [
            'sourceId' => SourceEnum::SPACE,
        ];
        $result = $this->handler->handle($request);

        $this->assertIsArray($result);
    }
}
