<?php

namespace Esperluet\Domain\News\PullNews;

class PullNewsRequest
{
    public ?string $keyword = null;

    public ?\DateTimeInterface $from = null;

    public ?\DateTimeInterface $to = null;
}