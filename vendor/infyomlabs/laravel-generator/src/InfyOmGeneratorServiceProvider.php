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
        $this->app->singleton('webcore.publish', function ($app) {
            return new GeneratorPublishCommand();
        });

        $this->app->singleton('webcore.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('webcore.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('webcore.publish.layout', function ($app) {
            return new LayoutPublishCommand();
        });

        $this->app->singleton('webcore.publish.templates', function ($app) {
            return new PublishTemplateCommand();
        });

        $this->app->singleton('webcore.api_scaffold', function ($app) {
            return new APIScaffoldGeneratorCommand();
        });

        $this->app->singleton('webcore.migration', function ($app) {
            return new MigrationGeneratorCommand();
        });

        $this->app->singleton('webcore.model', function ($app) {
            return new ModelGeneratorCommand();
        });

        $this->app->singleton('webcore.repository', function ($app) {
            return new RepositoryGeneratorCommand();
        });

        $this->app->singleton('webcore.api.controller', function ($app) {
            return new APIControllerGeneratorCommand();
        });

        $this->app->singleton('webcore.api.requests', function ($app) {
            return new APIRequestsGeneratorCommand();
        });

        $this->app->singleton('webcore.api.tests', function ($app) {
            return new TestsGeneratorCommand();
        });

        $this->app->singleton('webcore.scaffold.controller', function ($app) {
            return new ControllerGeneratorCommand();
        });

        $this->app->singleton('webcore.scaffold.requests', function ($app) {
            return new RequestsGeneratorCommand();
        });

        $this->app->singleton('webcore.scaffold.views', function ($app) {
            return new ViewsGeneratorCommand();
        });

        $this->app->singleton('webcore.rollback', function ($app) {
            return new RollbackGeneratorCommand();
        });

        $this->app->singleton('webcore.vuejs', function ($app) {
            return new VueJsGeneratorCommand();
        });
        $this->app->singleton('webcore.publish.vuejs', function ($app) {
            return new VueJsLayoutPublishCommand();
        });

        $this->commands([
            'webcore.publish',
            'webcore.api',
            'webcore.scaffold',
            'webcore.api_scaffold',
            'webcore.publish.layout',
            'webcore.publish.templates',
            'webcore.migration',
            'webcore.model',
            'webcore.repository',
            'webcore.api.controller',
            'webcore.api.requests',
            'webcore.api.tests',
            'webcore.scaffold.controller',
            'webcore.scaffold.requests',
            'webcore.scaffold.views',
            'webcore.rollback',
            'webcore.vuejs',
            'webcore.publish.vuejs',
        ]);
    }
}
