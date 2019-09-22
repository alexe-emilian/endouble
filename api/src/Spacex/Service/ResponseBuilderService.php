<?php

namespace App\Spacex\Service;

use App\Spacex\Response\SpacexClientResponse;
use App\Spacex\Response\SpacexResponse;

class ResponseBuilderService
{
    /**
     * @param $clientResponse
     * @return array
     */
    public function getResponse($clientResponse)
    {
        $data = [];

        /** @var SpacexClientResponse $spacexClientResponse */
        foreach ($clientResponse as $spacexClientResponse) {
            $data[] = (new SpacexResponse())
                ->setNumber($spacexClientResponse->getFlightNumber())
                ->setDate(date('Y-m-d', $spacexClientResponse->getLaunchDateUnix()))
                ->setName($spacexClientResponse->getMissionName())
                ->setLink($spacexClientResponse->getLinks()->getArticleLink())
                ->setDetails($spacexClientResponse->getDetails());
        }

        return $data;
    }
}
