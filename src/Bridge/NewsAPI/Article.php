<?php

namespace App\Bridge\NewsAPI;

class Article
{
    private mixed $source;

    private string $author;

    private string $title;

    private string $description;

    private string $url;

    private string $urlToImage;

    private \DateTimeInterface $publishedAt;

    private string $content;

    public function __construct(array $data)
    {
        $attributes = get_object_vars($this);

        foreach($data as $key => $value) {
            if(in_array($key, $attributes)) {
                $this->$key = $value;
            }
        }
    }

}
