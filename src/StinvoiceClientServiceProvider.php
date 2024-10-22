<?php

namespace Sankyutech\StinvoiceClient;

use Illuminate\Support\ServiceProvider;

class StinvoiceClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'stinvoice-client');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/stinvoice.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'stinvoice-migrations');

            $this->publishes([
                __DIR__.'/../config/stinvoice.php' => config_path('stinvoice.php'),
            ], 'stinvoice-config');

            // $this->publishes([
            //     __DIR__.'/../resources/views' => resource_path('views/vendor/stinvoice-client'),
            // ], 'stinvoice-views');

            // // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/stinvoice-client'),
            ], 'stinvoice-assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/stinvoice-client'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/stinvoice.php', 'stinvoice-client');

        // Register the main class to use with the facade
        $this->app->singleton('stinvoice-client', function () {
            return new StinvoiceClient;
        });
    }
}
