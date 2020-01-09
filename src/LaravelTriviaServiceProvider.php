<?php

namespace Chriscrawford1\LaravelTrivia;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use ChrisCrawford1\LaravelTrivia\Contracts\LaravelTrivia;

class LaravelTriviaServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

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
        $clientConfig = array_merge(['base_url' => 'https://opentdb.com/api.php'], $this->defaultHeaders);

        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-trivia');

        $this->app->bind(LaravelTrivia::class, function () use($clientConfig) {
            $guzzleClient = new Client($clientConfig);

            return new TriviaClient($guzzleClient);
        });
    }
}
