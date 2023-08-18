<?php

namespace Esperluet\Bridge\NewsAPI\Request;

final class SourcesRequest extends AbstractRequest
{
    public ?string $category = null;

    public ?string $language = null;

    public ?string $country = null;
}
