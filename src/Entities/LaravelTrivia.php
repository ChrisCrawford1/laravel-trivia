<?php

namespace ChrisCrawford1\LaravelTrivia\Entities;

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
