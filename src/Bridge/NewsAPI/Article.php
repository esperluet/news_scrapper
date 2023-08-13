<?php

namespace App\Bridge\NewsAPI;

class Article
{
    public mixed $source;

    public string $author;

    public string $title;

    public string $description;

    public string $url;

    public string $urlToImage;

    public \DateTimeInterface $publishedAt;

    public string $content;

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
