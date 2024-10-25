<?php

namespace Sankyutech\StInvoiceClient\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateStInvoiceTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stinvoice:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manual migration prepared database structure for stinvoice usage without merge with application migration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = "packages/sankyutech/stinvoice-client/database/migrations";

        Artisan::call('migrate', [
            '--path' => $path,
        ]);

        $this->info("Stinvoice database migrations have been run successfully.");
    }
}

