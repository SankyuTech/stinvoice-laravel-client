<?php

namespace Sankyutech\StInvoiceClient\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

use Sankyu\Client;
use Sankyu\One\Submission;
use Sankyu\CustomSankyuAuth;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

class StInvoiceCheckAndSubmit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stinvoice:check-submit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check submission table for einvoice submission';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $submissions = DB::table('stinvoice_submission')
                        ->whereNull('response')
                        ->whereNotNull('stinvoice_parameter_structure')
                        ->whereNotNull('stinvoice_company_id')
                        ->get();

        foreach ($submissions as $submission) {

            $config = [
                'api_key' => $supplier->stinvoice_key,
                'api_secret' => $supplier->stinvoice_secret,
                'use_sandbox'  => $supplier->stinvoice_sandbox,
            ];

            $httpClient = new GuzzleClient(['verify' => false]);

            $client = Client::make($httpClient, $config)
                ->provideAuth(new CustomSankyuAuth($config['api_key'], $config['api_secret']));


            $submission = $client->v1()->submissions()
                            ->invoice($submissions->stinvoice_parameter_structure);

            $responseBody = $submission->getBody();
            $result = json_decode($responseBody, true);

        }

        $this->info("Stinvoice check and submit have been run successfully.");
    }
}

