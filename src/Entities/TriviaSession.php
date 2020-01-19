<?php

namespace ChrisCrawford1\LaravelTrivia\Entities;

class TriviaSession extends AbstractTriviaSession
{
    /**
     * @return void
     */
    protected function storeSessionKey(): void
    {
        $response = $this->client->send($this->request);
        $sessionKey = json_decode($response->getBody()->getContents(), true)['token'];
        session([self::TRIVIA_SESSION_KEY => $sessionKey]);
    }

    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        if (! session()->exists(self::TRIVIA_SESSION_KEY)) {
            $this->storeSessionKey();
            return session()->get(self::TRIVIA_SESSION_KEY);
        }

        return session()->get(self::TRIVIA_SESSION_KEY);
    }
}
