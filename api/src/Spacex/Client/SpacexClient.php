<?php

namespace App\Spacex\Client;

use App\Api\Client\ApiClientInterface;
use App\Api\Exception\RequestException;
use App\Api\Service\ClientBuilderService;
use App\Spacex\Response\SpacexClientResponse;
use App\Spacex\Service\ResponseBuilderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SpacexClient implements ApiClientInterface
{
    private const BASE_URI = 'https://api.spacexdata.com/v2/launches';

    private const API_FILTERS = [
        'year' => 'launch_year',
        'limit' => 'limit',
    ];

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ResponseBuilderService
     */
    private $responseBuilderService;

    /**
     * SpacexClient constructor.
     * @param ClientBuilderService $clientBuilderService
     * @param ResponseBuilderService $responseBuilderService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ClientBuilderService $clientBuilderService,
        ResponseBuilderService $responseBuilderService,
        SerializerInterface $serializer
    ) {
        $this->client = $clientBuilderService->getClient();
        $this->responseBuilderService = $responseBuilderService;
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function list(array $parameters)
    {
        try {
            $url = $this->listUrl($parameters);
            $response = $this->client->request(Request::METHOD_GET, $url);

            $spacexClientResponse = $this->serializer->deserialize(
                $response->getContent(),
                sprintf("%s[]", SpacexClientResponse::class),
                'json'
            );

            return $this->responseBuilderService->getResponse($spacexClientResponse);
        } catch (\Throwable $exception) {
            throw new RequestException("An error occurred while communicating with the SpaceX api");
        }
    }

    /**
     * @param array $parameters
     * @return string
     */
    private function listUrl(array $parameters): string
    {
        $queryParameters = [];
        foreach (self::API_FILTERS as $requestFilter => $clientFilter) {
            if (isset($parameters[$requestFilter])) {
                $queryParameters[] = sprintf("%s=%s", $clientFilter, $parameters[$requestFilter]);
            }
        }

        if (0 !== count($queryParameters)) {
            return sprintf("%s?%s", self::BASE_URI, implode("&", $queryParameters));
        }

        return self::BASE_URI;
    }
}
