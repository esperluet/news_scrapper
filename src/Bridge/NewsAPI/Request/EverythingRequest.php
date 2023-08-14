<?php

namespace App\Bridge\NewsAPI\Request;

final class EverythingRequest extends AbstractRequest
{
    public ?string $q = null;
    
    public ?string $searchIn = null;
    
    public ?string $sources = null;
    
    public ?string $domains = null;
    
    public ?string $excludeDomains = null;
    
    public ?\DateTimeInterface $from = null;
    
    public ?\DateTimeInterface $to = null; 
    
    public ?string $language = null;
    
    public ?string $sortBy = null;
    
    public ?int $pageSize = null;
    
    public ?int $page = null;
}
