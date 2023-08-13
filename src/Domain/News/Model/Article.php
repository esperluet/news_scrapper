<?php

namespace App\Domain\News\Model;

class Article
{
    private string $articleId;

    private string $title;

    private string $author;

    private string $description;

    private string $url;

    private string $imageUrl;

    private string $content;

    private array $tags = [];

    private \DateTimeInterface $publishedAt;

    private \DateTimeInterface $createAt;

    public function __construct()
    {
        $this->createAt = new \DateTimeImmutable();
    }

    public function getArticleId(): string
    {
        return $this->articleId;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        
        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setPublishedAt(\DateTimeInterface $publishedAt): self 
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getPublishedAt(): \DateTimeInterface 
    {
        return $this->publishedAt;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function addTag(mixed $tag): self
    {
        $this->tags[] = $tag;
        
        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

}