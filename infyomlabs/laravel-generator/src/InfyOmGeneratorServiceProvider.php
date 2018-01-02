<?php

namespace InfyOm\Generator;

use Illuminate\Support\ServiceProvider;
use InfyOm\Generator\Commands\API\APIControllerGeneratorCommand;
use InfyOm\Generator\Commands\API\APIGeneratorCommand;
use InfyOm\Generator\Commands\API\APIRequestsGeneratorCommand;
use InfyOm\Generator\Commands\API\TestsGeneratorCommand;
use InfyOm\Generator\Commands\APIScaffoldGeneratorCommand;
use InfyOm\Generator\Commands\Common\MigrationGeneratorCommand;
use InfyOm\Generator\Commands\Common\ModelGeneratorCommand;
use InfyOm\Generator\Commands\Common\RepositoryGeneratorCommand;
use InfyOm\Generator\Commands\Publish\GeneratorPublishCommand;
use InfyOm\Generator\Commands\Publish\LayoutPublishCommand;
use InfyOm\Generator\Commands\Publish\PublishTemplateCommand;
use InfyOm\Generator\Commands\Publish\VueJsLayoutPublishCommand;
use InfyOm\Generator\Commands\RollbackGeneratorCommand;
use InfyOm\Generator\Commands\Scaffold\ControllerGeneratorCommand;
use InfyOm\Generator\Commands\Scaffold\RequestsGeneratorCommand;
use InfyOm\Generator\Commands\Scaffold\ScaffoldGeneratorCommand;
use InfyOm\Generator\Commands\Scaffold\ViewsGeneratorCommand;
use InfyOm\Generator\Commands\VueJs\VueJsGeneratorCommand;

class InfyOmGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/laravel_generator.php';

        $this->publishes([
            $configPath => config_path('infyom/laravel_generator.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('generate.publish', function ($app) {
            return new GeneratorPublishCommand();
        });

        $this->app->singleton('generate.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('generate.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('generate.publish.layout', function ($app) {
            return new LayoutPublishCommand();
        });

        $this->app->singleton('generate.publish.templates', function ($app) {
            return new PublishTemplateCommand();
        });

        $this->app->singleton('generate.api_scaffold', function ($app) {
            return new APIScaffoldGeneratorCommand();
        });

        $this->app->singleton('generate.migration', function ($app) {
            return new MigrationGeneratorCommand();
        });

        $this->app->singleton('generate.model', function ($app) {
            return new ModelGeneratorCommand();
        });

        $this->app->singleton('generate.repository', function ($app) {
            return new RepositoryGeneratorCommand();
        });

        $this->app->singleton('generate.api.controller', function ($app) {
            return new APIControllerGeneratorCommand();
        });

        $this->app->singleton('generate.api.requests', function ($app) {
            return new APIRequestsGeneratorCommand();
        });

        $this->app->singleton('generate.api.tests', function ($app) {
            return new TestsGeneratorCommand();
        });

        $this->app->singleton('generate.scaffold.controller', function ($app) {
            return new ControllerGeneratorCommand();
        });

        $this->app->singleton('generate.scaffold.requests', function ($app) {
            return new RequestsGeneratorCommand();
        });

        $this->app->singleton('generate.scaffold.views', function ($app) {
            return new ViewsGeneratorCommand();
        });

        $this->app->singleton('generate.rollback', function ($app) {
            return new RollbackGeneratorCommand();
        });

        $this->app->singleton('generate.vuejs', function ($app) {
            return new VueJsGeneratorCommand();
        });
        $this->app->singleton('generate.publish.vuejs', function ($app) {
            return new VueJsLayoutPublishCommand();
        });

        $this->commands([
            'generate.publish',
            'generate.api',
            'generate.scaffold',
            'generate.api_scaffold',
            'generate.publish.layout',
            'generate.publish.templates',
            'generate.migration',
            'generate.model',
            'generate.repository',
            'generate.api.controller',
            'generate.api.requests',
            'generate.api.tests',
            'generate.scaffold.controller',
            'generate.scaffold.requests',
            'generate.scaffold.views',
            'generate.rollback',
            'generate.vuejs',
            'generate.publish.vuejs',
        ]);
    }
}
