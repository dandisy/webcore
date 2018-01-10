<?php

namespace Webcore\Microsite;

use Illuminate\Support\ServiceProvider;

class MicrositeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__.'/routes.php';

        //$this->loadViewsFrom(__DIR__.'/views', 'microsite');

        $this->publishes([
            __DIR__.'/views' => storage_path('app/public/microsite'),
        ], 'views');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
