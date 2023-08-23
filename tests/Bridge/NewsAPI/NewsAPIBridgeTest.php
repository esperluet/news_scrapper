<?php

declare(strict_types=1);

namespace App\Tests\Bridge\NewsAPI;

use App\Bridge\NewsAPI\NewsAPIBridge;
use App\Bridge\NewsAPI\Request\EverythingRequest;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class NewsAPIBridgeTest extends TestCase
{
    private NewsAPIBridge $newsApiBridge;
    private MockHttpClient $httpClient;

    public function testEverythingGoodRequest()
    {
        $this->httpClient = new MockHttpClient([new MockResponse(ApiResponse::getGoodResponse())]);
        $this->newsApiBridge = new NewsAPIBridge('key', 'uri', 'version', $this->httpClient);
        $article = $this->newsApiBridge->getEverything(new EverythingRequest(['q' => 'england']));
        $this->assertNotEmpty($article);
    }


    /**
     * @dataProvider badEveryRequestProvider
     */
    public function testEverythingBadRequest(EverythingRequest $everyThingRequest, string $errorMessage)
    {
        $this->httpClient = new MockHttpClient([new MockResponse()]);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage($errorMessage);
        $this->newsApiBridge = new NewsAPIBridge('key', 'uri', 'version', $this->httpClient);
        $this->newsApiBridge->getEverything($everyThingRequest);
    }

    public function badEveryRequestProvider()
    {
        return array(
            [(new EverythingRequest([
                'q' => 'thing',
                'sortBy' => 'RangeOfNews',
            ])), 'unsupported sortBy value'],
            [(new EverythingRequest([
                'q' => 'thing',
                'searchIn' => 'author',
            ])), 'unsupported searchIn values'],
            [new EverythingRequest([
                'q' => 'thing',
                'to' => new DateTime(),
            ]), 'If "to" is filled, "from" should not be empty'],
            [new EverythingRequest([
                'q' => 'thing',
                'to' => new DateTime(),
                'from' => new DateTime('tomorrow')
            ]), 'date from can not be great than date to'],
            [new EverythingRequest([
                'q' => 'thing',
                'language' => 'French',
            ]), 'unsupported language'],
            [new EverythingRequest([
                'q' => 'thing',
                'pageSize' => 1000,
            ]), 'page Size too high'],
            [new EverythingRequest([]), 'you need a keyword!'],


        );
    }
}
