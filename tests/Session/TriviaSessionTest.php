<?php

use ChrisCrawford1\LaravelTrivia\Entities\LaravelTrivia;
use ChrisCrawford1\LaravelTrivia\Entities\TriviaSession as TriviaSession;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;


class TriviaSessionTest extends TestCase
{
    /**
     * @var MockHandler
     */
    private $mock;

    /**
     * @var HandlerStack
     */
    private $handler;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var \ChrisCrawford1\LaravelTrivia\Client
     */
    private $triviaClient;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = new MockHandler([
            new Response(200, [], '{"response_code":0,"response_message":"Token Generated Successfully!","token":"c9d8ccefd9b72a372a35444512e41f6b29f17e74dcb10d3885472d354564b667"}')
        ]);

        $this->handler = HandlerStack::create($this->mock);
        $this->client = new Client(['handler' => $this->handler]);
        $this->triviaClient = new \ChrisCrawford1\LaravelTrivia\Client($this->client);
    }

    /** @test */
    public function it_can_generate_a_session_key()
    {
        Config::set('using_session_token', true);
        $questions = new LaravelTrivia($this->triviaClient);
        $questions->get();
        $this->assertNotEmpty(session()->get(TriviaSession::TRIVIA_SESSION_KEY));
    }
}
