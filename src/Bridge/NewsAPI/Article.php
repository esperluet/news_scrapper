<?php

namespace App\Bridge\NewsAPI;

class Article
{
    public mixed $source;

    public ?string $author;

    public string $title;

    public string $description;

    public string $url;

    public ?string $urlToImage;

    public \DateTimeInterface $publishedAt;

    public string $content;

}
