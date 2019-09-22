<?php

namespace App\Api\Service;

use App\Api\Enum\ParameterEnum;
use App\Api\Exception\RequestException;
use App\Api\Handler\ApiHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiHandlerService
{
    /**
     * @var iterable
     */
    private $handlers;

    /**
     * ApiHandlerService constructor.
     * @param iterable $handlers
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getParameters(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }

    /**
     * @param array $parameters
     * @return mixed
     * @throws RequestException
     */
    public function handle(array $parameters)
    {
        if (false === isset($parameters[ParameterEnum::SOURCE])) {
            throw new RequestException(
                "Cannot handle requests without a sourceId. Please provide the parameter."
            );
        }

        /** @var ApiHandlerInterface $handler */
        foreach ($this->handlers as $handler) {
            if ($handler->canHandle($parameters)) {
                return $handler->handle($parameters);
            }
        }

        throw new RequestException(
            sprintf(
                "Cannot handle given source: %s.",
                $parameters[ParameterEnum::SOURCE]
            )
        );
    }
}
