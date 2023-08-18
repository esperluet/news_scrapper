<?php

namespace Esperluet\Domain\News\PullNews;

use Esperluet\Domain\News\Collection\ArticleCollectionInterface;
use Esperluet\Domain\News\PullNews\NewsEnricherInterface;
use Esperluet\Domain\News\PullNews\NewsFetcherInterface;
use Esperluet\Domain\News\PullNews\PullNewsRequest;

class PullNews
{
    public function __construct(
        private NewsFetcherInterface $fetcher,
        private NewsEnricherInterface $enricher,
        private ArticleCollectionInterface $articleCollection
    ) {        
    }

    public function execute(PullNewsRequest $request) : bool
    {
        $this->checkRequest($request);

        $articles = $this->fetcher->get($request->keyword, $request->from);
        
        if(!empty($articles)) {
            $enrichedArticles = $this->enricher->enrich($articles);
            $this->articleCollection->bulkSave($enrichedArticles);
            return true;
        }

        return false;
    }

    private function checkRequest(PullNewsRequest $request): void
    {
        if(empty($request->keyword)) {
            throw new \Exception('Empty keyword');
        }

        $maxDate = (new \DateTime('now'))->setTime(23, 59,59);
        if($request->from > $maxDate) {
            throw new \Exception('Date in the future :) ; max today at 23:59:59');
        }

        $minDate = (new \DateTime('now'))->setTime(23, 59,59);
        date_sub($minDate, date_interval_create_from_date_string('7 days'));
        if($request->from < $minDate) {
            throw new \Exception('Date in the past ; max 7 days before');
        }

    }
}
