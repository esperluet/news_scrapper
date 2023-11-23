<?php

namespace App\Domain\News\PullNews;

class PullNewsRequest
{
    public ?string $keyword = null;

    public ?\DateTimeInterface $from = null;

    public ?\DateTimeInterface $to = null;
    public function __construct(?array  $data = null)
    {
        $this->keyword = $data['keyword'] ?? null;
        $this->from = $data['from'] ?? null;
        $this->to = $data['to'] ?? null;
    }
}
