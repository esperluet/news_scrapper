<?php

namespace App\News\PullData;

use App\News\PullData\NewsFetcherInterface;
use App\News\PullData\NewsEnricherInterface;
use App\News\PullData\Collection\NewsCollectionInterface;
use App\News\PullData\PullDataRequest;

class PullData
{
    public function __construct(
        private NewsFetcherInterface $fetcher,
        private NewsEnricherInterface $enricher,
        private NewsCollectionInterface $newsCollection
    ) {        
    }

    public function execute(PullDataRequest $request) : bool
    {
        $this->checkRequest($request);

        $externalNews = $this->fetcher->get($request->keyword, $request->date);
        
        $newsCollection = $this->enricher->enrich($externalNews);
        
        $this->newsCollection->bulkSave($newsCollection);

        return true;
    }

    private function checkRequest(PullDataRequest $request): void
    {
        if(empty($request->keyword)) {
            throw new \Exception('Empty keyword');
        }

        $maxDate = (new \DateTime('now'))->setTime(23, 59,59);
        if($request->date > $maxDate) {
            throw new \Exception('Date in the future :) ; max today at 23:59:59');
        }

        $minDate = (new \DateTime('now'))->setTime(23, 59,59);
        date_sub($minDate, date_interval_create_from_date_string('7 days'));
        if($request->date < $minDate) {
            throw new \Exception('Date in the past ; max 7 days before');
        }

    }
}
