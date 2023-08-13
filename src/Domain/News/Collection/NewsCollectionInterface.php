<?php

namespace App\Domain\News\Collection;

use App\Domain\News\Model\Article;

interface NewsCollectionInterface
{
    public function get(string $newsId): Article;

    public function save(Article $article);

    /**
     * @var Article[] $articles
     */
    public function bulkSave(iterable $articles);
}
