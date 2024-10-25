<?php

namespace Sankyutech\StInvoiceClient;

use Illuminate\Support\ServiceProvider;
use Sankyutech\StInvoiceClient\Console\Commands\MigrateStInvoiceTable;

class StinvoiceClientServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'stinvoice-migrations');


            $this->commands([
                MigrateStInvoiceTable::class,
            ]);
        }
    }


    public function register()
    {
        $this->app->singleton('stinvoice-client', function () {
            return new StinvoiceClient();
        });
    }
}
