<?php

namespace App\News\PullData;

interface NewsEnricherInterface
{
    public function enrich(iterable $news) : iterable;
}
