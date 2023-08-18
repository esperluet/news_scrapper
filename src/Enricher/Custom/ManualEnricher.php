<?php

namespace Esperluet\Enricher\Custom;

use Esperluet\Domain\News\PullNews\NewsEnricherInterface;
use Esperluet\Domain\News\Model\Article;

class ManualEnricher implements NewsEnricherInterface
{

    /**
     * @var Article[] $articles
     * 
     * @return Aritcle[]
     */
    public function enrich(array $articles): array
    {
        $enrichedArticles = [];
        foreach($articles as $article) {
            $enrichedArticles[] = $this->tag($article);
        }
        return $enrichedArticles;
    }

    private function tag(Article $article, string $tag = 'Leonidas'): Article
    {
        return $article->addTag($tag);
    }

}
