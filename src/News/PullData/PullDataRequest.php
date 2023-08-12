<?php

namespace App\News\PullData;

class PullDataRequest
{
    public string $keyword;

    public \DateTimeInterface $date;
}