<?php

namespace Esperluet\Bridge\NewsAPI\Request;

final class TopHeadLinesRequest extends AbstractRequest
{
    public ?string $query = null;

    public ?string $country = null;

    public ?string $category = null;

    public ?string $source = null;
    
    public ?int $pageSize = null;
    
    public ?int $page = null;
}
