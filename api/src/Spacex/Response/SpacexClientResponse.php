<?php

namespace App\Spacex\Response;

use App\Spacex\Response\SpacexClientResponse\Links;
use Symfony\Component\Serializer\Annotation\SerializedName;

class SpacexClientResponse
{
    /**
     * @var int
     *
     * @SerializedName("flight_number")
     */
    private $flightNumber;

    /**
     * @var int
     *
     * @SerializedName("launch_date_unix")
     */
    private $launchDateUnix;

    /**
     * @var string
     *
     * @SerializedName("mission_name")
     */
    private $missionName;

    /**
     * @var Links
     *
     * @SerializedName("links")
     */
    private $links;

    /**
     * @var string|null
     *
     * @SerializedName("details")
     */
    private $details;

    /**
     * @return int
     */
    public function getFlightNumber(): int
    {
        return $this->flightNumber;
    }

    /**
     * @param int $flightNumber
     * @return SpacexClientResponse
     */
    public function setFlightNumber(int $flightNumber): SpacexClientResponse
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * @return int
     */
    public function getLaunchDateUnix(): int
    {
        return $this->launchDateUnix;
    }

    /**
     * @param int $launchDateUnix
     * @return SpacexClientResponse
     */
    public function setLaunchDateUnix(int $launchDateUnix): SpacexClientResponse
    {
        $this->launchDateUnix = $launchDateUnix;

        return $this;
    }

    /**
     * @return string
     */
    public function getMissionName(): string
    {
        return $this->missionName;
    }

    /**
     * @param string $missionName
     * @return SpacexClientResponse
     */
    public function setMissionName(string $missionName): SpacexClientResponse
    {
        $this->missionName = $missionName;

        return $this;
    }

    /**
     * @return Links
     */
    public function getLinks(): Links
    {
        return $this->links;
    }

    /**
     * @param Links $links
     * @return SpacexClientResponse
     */
    public function setLinks(Links $links): SpacexClientResponse
    {
        $this->links = $links;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDetails(): ?string
    {
        return $this->details;
    }

    /**
     * @param string|null $details
     * @return SpacexClientResponse
     */
    public function setDetails(?string $details): SpacexClientResponse
    {
        $this->details = $details;

        return $this;
    }
}
