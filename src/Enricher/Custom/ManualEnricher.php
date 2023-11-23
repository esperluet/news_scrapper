<?php

namespace App\Enricher\Custom;

use App\Domain\News\PullNews\NewsEnricherInterface;
use App\Domain\News\Model\Article;

class ManualEnricher implements NewsEnricherInterface
{

    /**
     * @var Article[] $articles
     * 
     * @return Article[]
     */
    public function enrich(array $articles): array
    {
        $enrichedArticles = [];
        foreach ($articles as $article) {
            $enrichedArticles[] = $this->tag($article);
        }
        return $enrichedArticles;
    }

    private function tag(Article $article, string $tag = 'Leonidas'): Article
    {
        return $article->addTag($tag);
    }
}
