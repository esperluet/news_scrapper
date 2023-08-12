<?php

namespace App\Bridge\NewsAPI;

use App\Bridge\NewsAPI\Request\{AbstractRequest, EverythingRequest, SourcesRequest, TopHeadLinesRequest};
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsAPIBridge
{
    private const COUNTRY_OPTIONS = [
        'ae', 'ar', 'au', 'be', 'bg', 'br', 'ca', 'ch', 'cn', 
        'co', 'cz', 'de', 'eg', 'fr', 'gb', 'gr', 'hk', 'hu', 
        'id', 'ie', 'il', 'in', 'it', 'jp', 'kr', 'lt', 'lv', 
        'ma', 'mx', 'ng', 'nl', 'no', 'nz', 'ph', 'pl', 'pt', 
        'ro', 'ro', 'rs', 'ru', 'sa', 'se', 'sg', 'si', 'sk', 
        'th', 'tr', 'tw', 'ua', 'us', 've', 'za',
    ];

    private const CATEGORY_OPTIONS = [
        'business',
        'entertainment',
        'general',
        'health',
        'science',  
        'sports',  
        'technology'
    ];

    private const SORT_BY_OPTIONS = [
        'relevancy',
        'popularity',
        'publishedAt'
    ];

    private const SEARCH_IN_OPTIONS = [
        'title',
        'description',
        'content'
    ];

    private const LANGUAGES_OPTIONS = [
        'ar', 'de', 'en', 'es', 'fr', 'he', 'it',
        'nl', 'no', 'pt', 'ru', 'sv', 'ud', 'zh'
    ];

    public function __construct(
        private string $apiKey,
        private string $apiBaseUri,
        private string $apiVersion,
        private HttpClientInterface $httpClient
    ) {        
    }

    /**
     * Get articles from newsAPI
     * 
     * @return Article[]
     */
    public function getEverything(EverythingRequest $request): ?array
    {
        $this->checkEverythingRequest($request);
        $endPoint = 'everything';

        $response = $this->httpClient->request(
            'GET',
            implode('/', [$this->apiBaseUri, $this->apiVersion, $endPoint]),
            [
                'query' => $this->buildHttpQuery($request)
            ]
        );

        if(200 === $response->getStatusCode()) {
            return $this->processResponse($response->toArray());
        }
        
        return null;
    }

    /**
     * Get articles from newsAPI
     * 
     * @return Article[]
     */
    public function getTopHeadlines(TopHeadLinesRequest $request): ?array
    {
        $this->checkTopHeadlinesRequest($request);
        $endPoint = 'top-headlines';

        $response = $this->httpClient->request(
            'GET',
            implode('/', [$this->apiBaseUri, $this->apiVersion, $endPoint]),
            [
                'query' => $this->buildHttpQuery($request)
            ]
        );

        if(200 === $response->getStatusCode()) {
            return $this->processResponse($response->toArray());
        }
        
        return null;
    }

    /**
     * Get articles from newsAPI
     * 
     * @return Article[]
     */
    public function getSources(SourcesRequest $request): ?array
    {
        $this->checkSourcesRequest($request);
        $endPoint = 'everything';

        $response = $this->httpClient->request(
            'GET',
            implode('/', [$this->apiBaseUri, $this->apiVersion, $endPoint]),
            [
                'query' => $this->buildHttpQuery($request)
            ]
        );

        if(200 === $response->getStatusCode()) {
            return $this->processResponse($response->toArray());
        }
        
        return null;
    }

    private function buildHttpQuery(AbstractRequest $request): array
    {
        $httpQuery = $request->toArray();
        $httpQuery['apiKey'] = $this->apiKey;

        return $httpQuery;
    }

    private function processResponse(array $content): ?array
    {
        if('ok' === $content['status']) {
            $articles = [];
            foreach($content as $article) {
                $articles[] = new Article($article);
            }
            return $articles;
        }

        if('error' === $content['status']) {
            throw new \Exception('unable to fetch data from newsAPI');
        }
    }

    private function checkEverythingRequest(EverythingRequest $request): void
    {
        if(!empty($request->sortBy) && !in_array($request->sortBy, self::SORT_BY_OPTIONS)) {
            throw new \Exception('unsupported sortBy value');
        }

        if(!empty($request->searchIn) && empty(array_intersect(explode(',', $request->searchIn), self::SEARCH_IN_OPTIONS))) {
            throw new \Exception('unsupported searchIn values');
        }

        if(empty($request->from) && !empty($request->to)) {
            throw new \Exception('If "to" is filled, "from" should not be empty');
        }

        if(!empty($request->from) && !empty($request->to) && $request->from > $request->to) {
            throw new \Exception('date from can not be great than date to');
        }

        if(!empty($request->language) && !in_array($request->language, self::LANGUAGES_OPTIONS)) {
            throw new \Exception('unsupported language');
        }

        if(!empty($request->pageSize) && 100 > $request->pageSize) {
            throw new \Exception('page Size too high');
        }
    }

    private function checkTopHeadlinesRequest(TopHeadLinesRequest $request): void
    {
        if(!empty($request->source) && !empty($request->country)) {
            throw new \Exception('both "category" and "source" can not be filled at same time');
        }

        if(!empty($request->category) && !in_array($request->category, self::CATEGORY_OPTIONS)) {
            throw new \Exception('Unsupported category');
        }

        if(!empty($request->country) && !in_array($request->country, self::COUNTRY_OPTIONS)) {
            throw new \Exception('Unsupported country');
        }

        if(!empty($request->pageSize) && 100 > $request->pageSize) {
            throw new \Exception('page Size too high');
        }
    }

    private function checkSourcesRequest(SourcesRequest $request): void
    {
        if(!empty($request->category) && !in_array($request->category, self::CATEGORY_OPTIONS)) {
            throw new \Exception('Unsupported category');
        }

        if(!empty($request->country) && !in_array($request->country, self::COUNTRY_OPTIONS)) {
            throw new \Exception('Unsupported country');
        }

        if(!empty($request->language) && in_array($request->language, self::LANGUAGES_OPTIONS)) {
            throw new \Exception('Unsupported language');
        }
    }
}
