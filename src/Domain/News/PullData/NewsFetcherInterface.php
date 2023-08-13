<?php

namespace App\Domain\News\PullData;

interface NewsFetcherInterface
{
    public function get(string $keyword, \DateTimeInterface $date) : array;
}
