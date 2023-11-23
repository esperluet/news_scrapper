<?php

declare(strict_types=1);

namespace App\Tests\Bridge\NewsAPI;

use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class ApiResponse
{

    private Json $goodResponse;

    public static function getGoodResponse()
    {
        return \file('./tests/Bridge/NewsAPI/response.json');
    }
}
