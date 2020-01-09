<?php

namespace ChrisCrawford1\LaravelTrivia;

use ChrisCrawford1\LaravelTrivia\Contracts\LaravelTrivia;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class TriviaClient implements LaravelTrivia
{
    /**
     * @var Client
     */
    private $client;

    /**
     * TriviaClient constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
