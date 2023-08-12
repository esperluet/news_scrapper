<?php

namespace App\Domain\News\PullData;

class PullDataRequest
{
    public string $keyword;

    public \DateTimeInterface $date;
}