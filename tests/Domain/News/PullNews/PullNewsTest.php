<?php

namespace App\Tests\Domain\News\PullNews;

use PHPUnit\Framework\TestCase;
use App\Domain\News\PullNews\PullNews;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Domain\News\PullNews\NewsFetcherInterface;
use App\Domain\News\PullNews\NewsEnricherInterface;
use App\Domain\News\Collection\ArticleCollectionInterface;
use App\Domain\News\PullNews\PullNewsRequest;
use DateTime;
use PHPUnit\Framework\MockObject\MockObject;

class PullNewsTest extends TestCase
{

    private MockObject $fetcher;
    private MockObject $enricher;
    private MockObject $articleCollection;

    public function setup(): void
    {
        $this->fetcher = $this->getMockBuilder(NewsFetcherInterface::class)->onlyMethods(['get'])
            ->getMock();
        $this->enricher = $this->getMockBuilder(NewsEnricherInterface::class)->onlyMethods(['enrich'])->getMock();
        $this->articleCollection = $this->getMockBuilder(ArticleCollectionInterface::class)->onlyMethods(['bulkSave', 'save', 'get'])->getMock();
    }

    /**
     * @dataProvider articleExceptionProvider
     */
    public function testCheckRequest(PullNewsRequest $pullRequest, string $exceptionMessage): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($exceptionMessage);
        $result = (new PullNews($this->fetcher, $this->enricher, $this->articleCollection))->execute($pullRequest);
    }

    public function testExecuteExpectWorking(
        PullNewsRequest $pullRequest = new PullNewsRequest(['keyword' => 'keyword', 'from' => new DateTime('now'), 'to' => new DateTime('now')]),
        $articles = ['true'],
        $enrichedArticles = ['expectTrue']
    ) {
        $this->fetcher->expects($this->once())->method('get')->willReturn($articles);
        $this->enricher->expects($this->once())->method('enrich')->willReturn($enrichedArticles);
        $this->articleCollection->expects($this->once())->method('bulkSave')->willReturn(null);
        $result = (new PullNews($this->fetcher, $this->enricher, $this->articleCollection))->execute($pullRequest);
        $this->assertTrue($result);
    }

    public function testExecuteArticleNull($pullRequest = new PullNewsRequest(['keyword' => 'keyword', 'from' => new DateTime('now'), 'to' => new DateTime('now')]), $articles = null)
    {
        $this->fetcher->expects($this->once())->method('get')->willReturn($articles);
        $this->enricher->expects($this->never())->method('enrich');
        $this->articleCollection->expects($this->never())->method('bulkSave');
        $result = (new PullNews($this->fetcher, $this->enricher, $this->articleCollection))->execute($pullRequest);
        $this->assertFalse($result);
    }
    public function articleExceptionProvider()
    {
        return array(
            [new PullNewsRequest(), 'Empty keyword'],
            [new PullNewsRequest(['keyword' => 'keyword', 'from' => new DateTime('tomorrow')]), 'Date in the future :) ; max today at 23:59:59'],
        );
    }
}
