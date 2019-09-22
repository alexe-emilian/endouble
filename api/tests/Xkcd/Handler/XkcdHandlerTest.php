<?php

namespace App\Tests\Xkcd\Handler;

use App\Api\Client\ApiClientInterface;
use App\Api\Enum\SourceEnum;
use App\Api\Handler\ApiHandlerInterface;
use App\Xkcd\Handler\XkcdHandler;
use PHPUnit\Framework\TestCase;

class XkcdHandlerTest extends TestCase
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
        $this->handler = new XkcdHandler($this->client);
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
            'sourceId' => SourceEnum::COMICS,
        ];
        $result = $this->handler->canHandle($request);

        $this->assertEquals(true, $result);
    }

    public function testRequestIsHandled()
    {
        $this->client->method('list')->willReturn([]);

        $request = [
            'sourceId' => SourceEnum::COMICS,
        ];
        $result = $this->handler->handle($request);

        $this->assertIsArray($result);
    }
}
