<?php

namespace App\Spacex\Response;

class SpacexResponse
{
    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $date;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string|null
     */
    private $details;

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return SpacexResponse
     */
    public function setNumber(int $number): SpacexResponse
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     * @return SpacexResponse
     */
    public function setDate(string $date): SpacexResponse
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return SpacexResponse
     */
    public function setName(string $name): SpacexResponse
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     * @return SpacexResponse
     */
    public function setLink(string $link): SpacexResponse
    {
        $this->link = $link;

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
     * @return SpacexResponse
     */
    public function setDetails(?string $details): SpacexResponse
    {
        $this->details = $details;

        return $this;
    }
}
