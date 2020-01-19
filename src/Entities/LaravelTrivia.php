<?php

namespace ChrisCrawford1\LaravelTrivia\Entities;

use ChrisCrawford1\LaravelTrivia\Contracts\LaravelTrivia as LaravelTriviaContract;
use ChrisCrawford1\LaravelTrivia\Exceptions\InvalidDataException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;

class LaravelTrivia
{
    /**
     * @var int - max is 50
     */
    private $noOfQuestions = 10;

    /**
     * @var string - Easy, Medium, Hard
     */
    private $difficulty = 'medium';

    /**
     * @var array
     */
    private $allowedDifficulties = ['easy', 'medium', 'hard'];

    /**
     * @var LaravelTriviaContract
     */
    private $client;

    /**
     * @var TriviaSession
     */
    private $session;

    /**
     * @var Repository
     */
    private $config;

    /**
     * LaravelTrivia constructor.
     * @param LaravelTriviaContract $client
     */
    public function __construct(LaravelTriviaContract $client)
    {
        $this->client = $client;
        $this->session = new TriviaSession();
        $this->config = config('laravel-trivia');
    }

    /**
     * @return Collection
     *
     * @throws InvalidDataException
     */
    public function get(): Collection
    {
        $request = new Request('GET', $this->buildQueryString());
        $response = $this->client->send($request);

        return collect(json_decode($response->getBody()->getContents(), true));
    }

    /**
     * @return string
     *
     * @throws InvalidDataException
     */
    private function buildQueryString(): string
    {
        if ($this->getNoOfQuestions() > 50) {
            throw new InvalidDataException(
                'You cannot request more than 50 questions at a time.',
                422
            );
        }

        if (! in_array($this->getDifficulty(), $this->allowedDifficulties)) {
            throw new InvalidDataException(
                "{$this->getDifficulty()} is not an allowed difficulty type.",
                '422'
            );
        }

        $queryString = "?amount={$this->getNoOfQuestions()}&difficulty={$this->getDifficulty()}";

        if ($this->config['using_session_token']) {
            $queryString .= "&token={$this->getSessionKey()}";
            return $queryString;
        }

        return $queryString;
    }

    /**
     * @return int
     */
    public function getNoOfQuestions(): int
    {
        return $this->noOfQuestions;
    }

    /**
     * @param int $noOfQuestions
     *
     * @return $this
     */
    public function setNoOfQuestions(int $noOfQuestions): self
    {
        $this->noOfQuestions = $noOfQuestions;

        return $this;
    }

    /**
     * @return string
     */
    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    /**
     * @param string $difficulty
     *
     * @return $this
     */
    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = strtolower($difficulty);

        return $this;
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->session->getSessionKey();
    }
}
