<?php

namespace App\Domain\News\Collection;

use App\Domain\News\Model\Article;

interface ArticleCollectionInterface
{
    public function get(string $articleId): ?Article;

    public function save(Article $article);

    /**
     * @var Article[] $articles
     */
    public function bulkSave(iterable $articles);
}
