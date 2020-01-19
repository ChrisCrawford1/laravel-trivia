<?php

namespace ChrisCrawford1\LaravelTrivia\Entities;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

abstract class AbstractTriviaSession
{
    CONST TRIVIA_SESSION_KEY = 'trivia_session_key';

    /**
     * @var Client
     */
    public $client;

    /**
     * @var Request
     */
    public $request;

    /**
     * TriviaSession constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->request = new Request('GET', 'https://opentdb.com/api_token.php?command=request');
    }

    /**
     * @return void
     */
    protected abstract function storeSessionKey(): void;

    /**
     * @return string
     */
    public abstract function getSessionKey(): string;
}
