<?php

namespace App\Domain\News\PullData;

interface NewsEnricherInterface
{
    public function enrich(iterable $news) : iterable;
}
