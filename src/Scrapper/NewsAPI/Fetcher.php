<?php

namespace App\Scrapper\NewsAPI;

use App\Bridge\NewsAPI\NewsAPIBridge;
use App\Bridge\NewsAPI\Request\EverythingRequest;
use App\Domain\News\PullNews\NewsFetcherInterface;
use App\Bridge\NewsAPI\Article as ExternalArticle;
use App\Domain\News\Model\Article;

class Fetcher implements NewsFetcherInterface
{
    public function __construct(
        private NewsAPIBridge $newsApi
    ) {        
    }

    /**
     * 
     * @return Article[]
     */
    public function get(string $keyword, \DateTimeInterface $date) : ?array
    {
        $request = new EverythingRequest(['q' => $keyword, 'from' => $date]);

        /**
         * @var ExternalArticle[] $externalsArticles 
         */
        $externalsArticles = $this->newsApi->getEverything($request);

        if(!empty($externalsArticles)) {
            $articles = [];
            foreach($externalsArticles as $externalsArticle) {
                $articles[] = $this->newsApiArticleToArticle($externalsArticle);
            }
            return $articles;
        }
        
        return null;
    }

    private function newsApiArticleToArticle(ExternalArticle $externalsArticle): Article
    {
        return (new Article())
                    ->setTitle($externalsArticle->title)
                    ->setDescription($externalsArticle->description)
                    ->setAuthor($externalsArticle->author)
                    ->setContent($externalsArticle->content)
                    ->setUrl($externalsArticle->url)
                    ->setImageUrl($externalsArticle->url)
                    ->setPublishedAt($externalsArticle->publishedAt);
    }
}
