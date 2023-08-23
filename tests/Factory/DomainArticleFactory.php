<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Domain\News\Model\Article;
use DateTime;

class DomainArticleFactory
{
    public static function create(
        string $title = 'test',
        string $description = 'thing',
        string $author = 'anon',
        string $content = 'none',
        string $url = 'none',
        string $imageUrl = 'none',
        $publishedAt = new DateTime()
    ) {
        return (new Article())
            ->setTitle($title)
            ->setDescription($description)
            ->setAuthor($author)
            ->setContent($content)
            ->setUrl($url)
            ->setImageUrl($imageUrl)
            ->setPublishedAt($publishedAt);
    }
}
