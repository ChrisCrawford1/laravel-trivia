<?php

namespace ChrisCrawford1\LaravelTrivia;

use ChrisCrawford1\LaravelTrivia\Contracts\LaravelTrivia;
use GuzzleHttp\Client as Guzzle;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client implements LaravelTrivia
{
    /**
     * @var Guzzle
     */
    private $client;

    /**
     * Client constructor.
     * @param Guzzle $client
     */
    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        return $this->client->send($request);
    }
}
