<?php

namespace App\Api\Controller;

use App\Api\Exception\RequestException;
use App\Api\Response\ApiResponse;
use App\Api\Service\ApiHandlerService;
use App\Api\Service\ResponseErrorService;
use App\Api\Service\ResponseMetadataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/resources", name="default_")
 */
class ResourceController extends AbstractController
{
    /**
     * @var ApiHandlerService
     */
    private $apiHandlerService;

    /**
     * @var ResponseMetadataService
     */
    private $responseMetadataService;

    /**
     * @var ResponseErrorService
     */
    private $responseErrorService;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * DefaultController constructor.
     * @param ApiHandlerService $apiHandlerService
     * @param ResponseMetadataService $responseMetadataService
     * @param ResponseErrorService $responseErrorService
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ApiHandlerService $apiHandlerService,
        ResponseMetadataService $responseMetadataService,
        ResponseErrorService $responseErrorService,
        SerializerInterface $serializer
    ) {
        $this->apiHandlerService = $apiHandlerService;
        $this->responseMetadataService = $responseMetadataService;
        $this->responseErrorService = $responseErrorService;
        $this->serializer = $serializer;
    }

    /**
     * @Route("",  methods={"POST"}, name="list")
     *
     * @param Request $request
     * @return Response
     * @throws RequestException
     */
    public function listAction(Request $request): Response
    {
        $parameters = $this->apiHandlerService->getParameters($request);
        $meta = $this->responseMetadataService->getMeta($parameters);
        $data = $this->apiHandlerService->handle($parameters);

        return $this->json(
            new ApiResponse($meta, $data),
            Response::HTTP_OK,
            [],
            [
                'json_encode_options' => JSON_UNESCAPED_SLASHES
            ]
        );
    }
}
