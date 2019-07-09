<?php

namespace Webcore\Elorest;

use Illuminate\Support\ServiceProvider;
use Webcore\Elorest\Http\Request\IRequest;
use Webcore\Elorest\Http\Request\LaravelRequest;
use Webcore\Elorest\Repository\IRepository;
use Webcore\Elorest\Repository\EloquentRepository;
use Webcore\Elorest\Http\Middleware\LaravelMiddleware;
use Webcore\Elorest\Http\Response\IResponse;
use Webcore\Elorest\Http\Response\LaravelResponse;
use Webcore\Elorest\Route\LaravelRoute;
use Webcore\Elorest\Service\AService;
use Webcore\Elorest\Service\LaravelService;

class ElorestServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'../Exceptions' => app_path('Exceptions'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IRequest::class,
            LaravelRequest::class
        );

        $this->app->bind(
            IRepository::class,
            EloquentRepository::class
        );

        $this->app->bind(
            IResponse::class,
            LaravelResponse::class
        );

        $this->app->bind(
            AService::class,
            LaravelService::class
        );

        // $this->app->bind(LaravelMiddleware::class, function($app) {
        //     return new LaravelMiddleware($app->make(LaravelRoute::class));
        // });
        $this->app->bind('LaravelMiddleware', function($app) {
            return new LaravelMiddleware($app->make(LaravelRoute::class));
        });
    }
}
