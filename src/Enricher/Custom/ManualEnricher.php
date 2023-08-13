<?php

namespace App\Enricher\Custom;

use App\Domain\News\PullData\NewsEnricherInterface;
use App\Domain\News\Model\Article;

class ManualEnricher implements NewsEnricherInterface
{

    /**
     * @var Article[] $articles
     * 
     * @return Aritcle[]
     */
    public function enrich(array $articles): array
    {
        return array_map('addTag', $articles);
    }

    private function addTag(Article $article): Article
    {
        return $article->addTag('Leonidas');
    }

}
