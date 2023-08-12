<?php

namespace App\Domain\News\Collection;

use App\News\Model\News;

interface NewsCollectionInterface
{
    public function get(string $newsId): News;

    public function save(News $news);

    public function bulkSave(iterable $newsList);
}
