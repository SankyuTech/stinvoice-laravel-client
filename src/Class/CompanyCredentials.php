<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Sankyu\Client;
use Sankyu\One\Submission;
use Sankyu\CustomSankyuAuth;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

class CompanyCredentials
{
	public $internal_reference_id;

	public function __construct($internal_reference_id)
    {
        $this->internal_reference_id = $internal_reference_id;
    }

	public function getCredential(){

		$credential = DB::table('stinvoice_company')
					 ->select('stinvoice_key','stinvoice_secret','stinvoice_production','status')
					 ->where('internal_reference_id',$this->internal_reference_id)
					 ->first();

		return $credential;
	}

	public function verifyAccess($key,$secret,$sandbox=true){

		try {

			$config = [
			    'api_key' => $key,
			    'api_secret' => $secret,
			    'use_sandbox'  => $sandbox == 1 ? true : false,
			];

			$httpClient = new GuzzleClient(['verify' => false]);

			$client = Client::make($httpClient, $config)
	    	->provideAuth(new CustomSankyuAuth($config['api_key'], $config['api_secret']));

	    	$submission = $client->v1()->submissions()->checkAccess();

			$responseBody = $submission->getBody();

			$result = json_decode($responseBody, true);

			dd($result);

			if($result['data'] == 'pong'){

				return true;
			}
			
		} catch (Exception $e) {
				
			return false;
		}

    }

	public function saveCredential($data){

		DB::table('stinvoice_company')
		->updateOrInsert(
			[
				'internal_reference_id' => $this->internal_reference_id
			],
			[
			 	'stinvoice_key' => $data['stinvoice_key'] ?? NULL,
			 	'stinvoice_secret' => $data['stinvoice_secret'] ?? NULL,
			 	'stinvoice_sandbox' => $data['stinvoice_sandbox'] ?? false,
			 	'status' => $data['status'] ?? false,
			 	'updated_at' => Carbon::now(),
			]
		);
	}
    
}
