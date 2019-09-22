<?php

namespace App\Spacex\Response\SpacexClientResponse;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Links
{
    /**
     * @var string
     *
     * @SerializedName("article_link")
     */
    private $articleLink;

    /**
     * @return string
     */
    public function getArticleLink(): string
    {
        return $this->articleLink;
    }

    /**
     * @param string $articleLink
     * @return Links
     */
    public function setArticleLink(string $articleLink): Links
    {
        $this->articleLink = $articleLink;

        return $this;
    }
}
