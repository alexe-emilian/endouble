<?php

namespace App\Spacex\Handler;

use App\Api\Client\ApiClientInterface;
use App\Api\Enum\ParameterEnum;
use App\Api\Enum\SourceEnum;
use App\Api\Handler\ApiHandlerInterface;

class SpacexHandler implements ApiHandlerInterface
{
    /**
     * @var ApiClientInterface
     */
    private $client;

    /**
     * SpacexHandler constructor.
     * @param ApiClientInterface $client
     */
    public function __construct(
        ApiClientInterface $client
    ) {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function canHandle(array $parameters): bool
    {
        if (SourceEnum::SPACE === $parameters[ParameterEnum::SOURCE]) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function handle(array $parameters)
    {
        return $this->client->list($parameters);
    }
}
