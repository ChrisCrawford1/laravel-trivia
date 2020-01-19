<?php

namespace ChrisCrawford1\LaravelTrivia\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface LaravelTrivia
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface;
}
