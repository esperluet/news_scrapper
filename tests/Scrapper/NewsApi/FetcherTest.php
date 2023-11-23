<?php

declare(strict_types=1);

namespace App\Tests\Scrapper\NewsApi;

use DateTime;
use PHPUnit\Framework\TestCase;
use App\Scrapper\NewsAPI\Fetcher;
use App\Domain\News\Model\Article;
use App\Bridge\NewsAPI\NewsAPIBridge;
use PHPUnit\Framework\MockObject\MockObject;
use App\Bridge\NewsAPI\Article as ExternalArticle;
use App\Tests\Factory\ExternalArticleFactory;

class FetcherTest extends TestCase
{
    private MockObject $newsApi;
    private Fetcher $fetcher;

    public function setup(): void
    {
        $this->newsApi = $this->createMock(NewsAPIBridge::class);
        $this->fetcher = new Fetcher($this->newsApi);
    }
    /**
     * @dataProvider getWorkingProvider
     */
    public function testGet(string $keyword, \DateTimeInterface $date, array $articles)
    {
        $this->newsApi->expects($this->once())->method('getEverything')->willReturn($articles);
        $articlesFetched = $this->fetcher->get($keyword, $date);
        $this->assertNotNull($articlesFetched);
        $this->assertIsArray($articlesFetched);
        $this->assertInstanceOf(Article::class, $articlesFetched[0]);
    }
    public function testGetNull(string $keyword = 'things', \DateTimeInterface $date = new DateTime())
    {
        $this->newsApi->expects($this->once())->method('getEverything')->willReturn([]);
        $articlesFetched = $this->fetcher->get($keyword, $date);
        $this->assertNull($articlesFetched);
    }
    public function getWorkingProvider()
    {
        return array(
            [
                'bonjour', new DateTime(),
                [
                    ExternalArticleFactory::create('titre'),
                    ExternalArticleFactory::create('title'),
                    ExternalArticleFactory::create('trucs'),
                ]
            ],
        );
    }
}
