<?php

namespace App\News\PullData;

interface NewsFetcherInterface
{
    public function get(string $keyword, \DateTimeInterface $date) : iterable;
}
