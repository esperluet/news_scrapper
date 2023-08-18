<?php

namespace Esperluet\Domain\News\PullNews;

interface NewsFetcherInterface
{
    public function get(string $keyword, \DateTimeInterface $date) : ?array;
}
