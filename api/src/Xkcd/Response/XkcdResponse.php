<?php

namespace App\Xkcd\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

class XkcdResponse
{
    /**
     * @var string
     */
    private $year;

    /**
     * @var string
     */
    private $month;

    /**
     * @var string
     */
    private $day;

    /**
     * @var int
     *
     * @SerializedName("num")
     */
    private $number;

    /**
     * @var string
     */
    private $link;

    /**
     * @var string
     *
     * @SerializedName("safe_title")
     */
    private $title;

    /**
     * @var string
     */
    private $transcript;

    /**
     * @var string
     *
     * @SerializedName("img")
     */
    private $image;

    /**
     * @return string
     */
    public function getYear(): string
    {
        return $this->year;
    }

    /**
     * @param string $year
     * @return XkcdResponse
     */
    public function setYear(string $year): XkcdResponse
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonth(): string
    {
        return $this->month;
    }

    /**
     * @param string $month
     * @return XkcdResponse
     */
    public function setMonth(string $month): XkcdResponse
    {
        $this->month = $month;

        return $this;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @param string $day
     * @return XkcdResponse
     */
    public function setDay(string $day): XkcdResponse
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return XkcdResponse
     */
    public function setNumber(int $number): XkcdResponse
    {
        $this->number = $number;

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
     * @return XkcdResponse
     */
    public function setLink(string $link): XkcdResponse
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return XkcdResponse
     */
    public function setTitle(string $title): XkcdResponse
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTranscript(): string
    {
        return $this->transcript;
    }

    /**
     * @param string $transcript
     * @return XkcdResponse
     */
    public function setTranscript(string $transcript): XkcdResponse
    {
        $this->transcript = $transcript;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return XkcdResponse
     */
    public function setImage(string $image): XkcdResponse
    {
        $this->image = $image;

        return $this;
    }
}
