<?php

namespace Chriscrawford1\LaravelTrivia;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Chriscrawford1\LaravelTrivia\Skeleton\SkeletonClass
 */
class LaravelTriviaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-trivia';
    }
}
