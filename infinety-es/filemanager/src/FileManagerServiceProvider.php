<?php

namespace Infinety\FileManager;

use Illuminate\Support\ServiceProvider;
use Infinety\FileManager\Helpers\FileManagerHelper;

class FileManagerServiceProvider extends ServiceProvider
{


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->loadViewsFrom(__DIR__.'/views/', 'filemanager');

        // /**
        //  * Publishes Lang files
        //  */
        // $this->publishes([
        //     realpath(__DIR__.'/resources/lang') => $this->app->basePath().'/resources/lang'
        // ], 'lang');
        // 

        /**
         * Publish Public Assets
         */
        $this->publishes([
            __DIR__.'/public' => public_path('filemanager_assets'),
        ], 'public');


        /**
         * Publish Layout view
         */
        $this->publishes([
            __DIR__.'/Views/layout' => base_path('resources/views/layouts'),
        ], 'layout');


        /**
         * Publish default views
         */
        $this->publishes([
            __DIR__.'/Views/default_views' => base_path('resources/views/vendor/infinety/filemanager'),
        ], 'views');

        /**
         * Publish config file
         */
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('filemanager.php')
        ], 'config');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('FileManagerHelper', function () {
            return new FileManagerHelper;
        });

        //Load Services Providers
        $this->app->register('Chumper\Zipper\ZipperServiceProvider');
        
        // Register dependancy aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Zipper', 'Chumper\Zipper\Zipper');

        $this->app->singleton('filemanager', 'Infinety\FileManager\Helpers\FileManagerHelper');

        $this->app->make('Infinety\FileManager\Controllers\FileManagerController');
//        \Route::group(['prefix' => 'admin/filemanager', 'middleware' => 'auth'], function() {
//            \Route::controller('/', 'Infinety\FileManager\Controllers\FileManagerController');
//        });

    }

}
