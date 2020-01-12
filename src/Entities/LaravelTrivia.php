<?php

namespace ChrisCrawford1\LaravelTrivia\Entities;

use ChrisCrawford1\LaravelTrivia\InvalidDataException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class LaravelTrivia
{
    /**
     * @var int
     */
    private $noOfQuestions = 10;

    /**
     * @var string
     */
    private $difficulty = 'medium';

    /**
     * @var Client
     */
    private $client;

    /**
     * LaravelTrivia constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://opentdb.com/api.php'
        ]);
    }

    /**
     * @return array
     *
     * @throws InvalidDataException
     */
    public function get(): array
    {
        $request = new Request('GET', $this->buildQueryString());

        $response = $this->client->send($request);

        return json_decode($response->getBody()->getContents(), true);
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

        return "?amount={$this->getNoOfQuestions()}&difficulty={$this->getDifficulty()}";
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
        $this->difficulty = $difficulty;

        return $this;
    }
}
