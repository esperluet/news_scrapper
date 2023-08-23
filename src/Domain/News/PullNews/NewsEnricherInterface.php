<?php

namespace App\Domain\News\PullNews;

use App\Domain\News\Model\Article;

interface NewsEnricherInterface
{
    /**
     * @var Article[] $articles
     * 
     * @return Article[]
     */
    public function enrich(array $articles): array;
}
