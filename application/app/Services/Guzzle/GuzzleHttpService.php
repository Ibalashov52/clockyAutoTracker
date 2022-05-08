<?php

namespace App\Services\Guzzle;

use App\Enums\HttpRequestMethods;
use GuzzleHttp\Client;

class GuzzleHttpService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setClientParams(array $params = [])
    {
        return $this->client = new Client($params);
    }

    public function get($uri, $options = [], $json = false)
    {
        return self::request(HttpRequestMethods::get->value, $uri, $options, $json);
    }

    public function post($uri, $options = [], $json = false)
    {
        return self::request(HttpRequestMethods::post->value, $uri, $options, $json);
    }

    private function request(string $method, string $uri, array|string $options = [], $json = false)
    {
        $response = $this->client->request($method, $uri, $options);
        $responseContents = $response->getBody()->getContents();

        return $json ? $responseContents : json_decode($responseContents, true);
    }
}
