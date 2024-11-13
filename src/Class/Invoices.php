<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Sankyu\Client;
use Sankyu\One\Submission;
use Sankyu\CustomSankyuAuth;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;

class Invoices
{
	public $company_reference_id;

	public function __construct($company_reference_id)
    {
        $this->company_reference_id = $company_reference_id;
    }

    public function checkTaxNo($key,$secret,$sandbox,$tin,$id,$id_type){

    	try {

			$config = [
			    'api_key' => $key,
			    'api_secret' => $secret,
			    'use_sandbox'  => $sandbox == 1 ? true : false,
			];

			$httpClient = new GuzzleClient(['verify' => false]);

			$client = Client::make($httpClient, $config)
	    	->provideAuth(new CustomSankyuAuth($config['api_key'], $config['api_secret']));

	    	$data['tax_identification_no'] = $tin;
	    	$data['identification_type'] = $id_type;
	    	$data['identification_no'] = $id;

	    	$submission = $client->v1()->submissions()->checkIdentificationParty($data);

			$responseBody = $submission->getBody();

			$result = json_decode($responseBody, true);

			if($result['message'] == "Verified"){

				return true;
			}
			
		} catch (Exception $e) {
				
			return false;
		}

    }

	public function getInvoice($einvoice_submission_invoice_uuid){

		$invoice = DB::table('stinvoice_submission')
					 ->where('einvoice_submission_invoice_uuid',$einvoice_submission_invoice_uuid)
					 ->first();

		return $invoice;
	}

	public function getSubmission($einvoice_submission_uuid){

		$submission = DB::table('stinvoice_submission')
					 ->where('einvoice_submission_uuid',$einvoice_submission_uuid)
					 ->first();

		return $submission;
	}
    
}
