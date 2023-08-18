<?php

namespace Esperluet\Domain\News\PullNews;

use Esperluet\Domain\News\Model\Article;

interface NewsEnricherInterface
{
    /**
     * @var Article[] $articles
     * 
     * @return Aritcle[]
     */
    public function enrich(array $articles) : array;
}
