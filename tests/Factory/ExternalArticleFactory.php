<?php

declare(strict_types=1);

namespace App\Tests\Factory;

use App\Bridge\NewsAPI\Article;
use DateTime;

class ExternalArticleFactory
{
    public static function create($title = 'no title')
    {
        $article = new Article();
        $article->title = $title;
        $article->description = 'test';
        $article->author = null;
        $article->content = 'test';
        $article->url = 'none';
        $article->urlToImage = 'none';
        $article->publishedAt = new DateTime();
        return $article;
    }
}
