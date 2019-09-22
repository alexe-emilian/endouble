<?php

namespace App\Api\EventListener;

use App\Api\Response\ApiErrorResponse;
use App\Api\Service\ApiHandlerService;
use App\Api\Service\ResponseErrorService;
use App\Api\Service\ResponseMetadataService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Serializer\SerializerInterface;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var ResponseMetadataService
     */
    private $responseMetadataService;

    /**
     * @var ResponseErrorService
     */
    private $responseErrorService;

    /**
     * @var ApiHandlerService
     */
    private $apiHandlerService;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ApiExceptionSubscriber constructor.
     * @param ResponseMetadataService $responseMetadataService
     * @param ResponseErrorService $responseErrorService
     * @param ApiHandlerService $apiHandlerService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ResponseMetadataService $responseMetadataService,
        ResponseErrorService $responseErrorService,
        ApiHandlerService $apiHandlerService,
        SerializerInterface $serializer
    ) {
        $this->responseMetadataService = $responseMetadataService;
        $this->responseErrorService = $responseErrorService;
        $this->apiHandlerService = $apiHandlerService;
        $this->serializer = $serializer;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $parameters = $this->apiHandlerService->getParameters($event->getRequest());
        $meta = $this->responseMetadataService->getErrorMeta($parameters);
        $errors = $this->responseErrorService->getErrors($event->getException());

        $apiResponse = new ApiErrorResponse($meta, $errors);
        $response = new JsonResponse(
            $this->serializer->serialize($apiResponse, 'json'),
            Response::HTTP_BAD_REQUEST,
            [
                'json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS,
            ],
            true
        );

        $event->setResponse($response);
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
