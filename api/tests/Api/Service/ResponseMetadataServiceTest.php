<?php

namespace App\Tests\Api\Service;

use App\Api\Service\ResponseMetadataService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class ResponseMetadataServiceTest extends TestCase
{
    public function testMetaDataIsGeneratedSuccessfully(): void
    {
        $service = new ResponseMetadataService();
        $result = $service->getMeta([]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('request', $result);
        $this->assertIsArray($result['request']);
        $this->assertArrayHasKey('timestamp', $result);
        $this->assertInstanceOf(\DateTime::class, $result['timestamp']);
    }

    public function testErrorMetaDataIsGeneratedSuccessfully(): void
    {
        $service = new ResponseMetadataService();
        $result = $service->getErrorMeta([]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('request', $result);
        $this->assertIsArray($result['request']);
    }
}
