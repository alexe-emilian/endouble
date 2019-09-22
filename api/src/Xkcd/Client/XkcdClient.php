<?php

namespace App\Xkcd\Client;

use App\Api\Client\ApiClientInterface;
use App\Api\Exception\RequestException;
use App\Api\Service\ClientBuilderService;
use App\Xkcd\Response\XkcdResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class XkcdClient implements ApiClientInterface
{
    private const BASE_URI = 'http://xkcd.com';
    private const RESOURCE = 'info.0.json';
    private const API_FILTERS = 'numbers';

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * SpacexClient constructor.
     * @param SerializerInterface $serializer
     * @param ClientBuilderService $clientBuilderService
     */
    public function __construct(
        SerializerInterface $serializer,
        ClientBuilderService $clientBuilderService
    ) {
        $this->client = $clientBuilderService->getClient();
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function list(array $parameters)
    {
        try {
            $responses = [];
            foreach ($this->getNumbers($parameters) as $number) {
                $url = $this->getUrl($number);
                $responses[] = $this->client->request(Request::METHOD_GET, $url);
            }

            $xkcdResponse = [];
            foreach ($responses as $response) {
                $xkcdResponse[] = $this->serializer->deserialize(
                    $response->getContent(),
                    XkcdResponse::class,
                    'json'
                );
            }

            return $xkcdResponse;
        } catch (\Throwable $exception) {
            throw new RequestException('An error occurred while communicating with the XKCD api');
        }
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function getNumbers(array $parameters): array {
        if(false === isset($parameters[self::API_FILTERS])) {
            return [null];
        }

        if ("array" === gettype($parameters[self::API_FILTERS])) {
            return $parameters[self::API_FILTERS];
        }

        return explode(",", $parameters[self::API_FILTERS]);
    }

    /**
     * @param string|null $number
     * @return string
     */
    private function getUrl(?string $number = null): string
    {
        if (null !== $number) {
            return sprintf(
                "%s/%s/%s",
                self::BASE_URI,
                $number,
                self::RESOURCE
            );
        }

        return sprintf(
            "%s/%s",
            self::BASE_URI,
            self::RESOURCE
        );
    }
}
