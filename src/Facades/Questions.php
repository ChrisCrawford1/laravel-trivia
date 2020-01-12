<?php

namespace ChrisCrawford1\LaravelTrivia\Facades;

use ChrisCrawford1\LaravelTrivia\Entities\LaravelTrivia;
use Illuminate\Support\Facades\Facade;

class Questions extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return LaravelTrivia::class;
    }
}
