<?php

namespace Chriscrawford1\LaravelTrivia;

use ChrisCrawford1\LaravelTrivia\Contracts\LaravelTrivia;
use GuzzleHttp\Client as Client;
use Illuminate\Support\ServiceProvider;

class LaravelTriviaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-trivia.php'),
            ], 'config');

            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-trivia');

        $this->app->bind(LaravelTrivia::class, function () {
            $guzzle = new Client([
                'base_uri' => 'https://opentdb.com/api.php'
            ]);

            return new \ChrisCrawford1\LaravelTrivia\Client($guzzle);
        });
    }
}
