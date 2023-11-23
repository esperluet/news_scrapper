<?php

declare(strict_types=1);

namespace App\Tests\Enricher\Custom;

use App\Domain\News\Model\Article;
use App\Enricher\Custom\ManualEnricher;
use App\Tests\Factory\DomainArticleFactory;
use PHPUnit\Framework\TestCase;

class ManualEnricherTest extends TestCase
{

    private ManualEnricher $enricher;
    private Article $article;

    public function setUp(): void
    {
        $this->enricher = new ManualEnricher();
        $this->article = DomainArticleFactory::create();
    }
    public function testEnrich()
    {
        $articles = [DomainArticleFactory::create(), DomainArticleFactory::create()];
        $taggedArticle = $this->enricher->enrich($articles);
        $this->assertIsIterable($taggedArticle);
        $this->assertEquals(\count($articles), count(
            \array_filter(
                $taggedArticle,
                fn ($article) => \in_array('Leonidas', $article->getTags())
            )
        ));
    }
}
