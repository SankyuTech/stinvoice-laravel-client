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

	public function saveInvoice($data){

		DB::table('stinvoice_invoices')
		->insert(
			[
			 	'ulid' => $data['ulid'] ?? NULL,
			 	'stinvoice_submission_id' => $data['stinvoice_submission_id'] ?? NULL,
			 	'stinvoice_company_id' => $data['stinvoice_company_id'] ?? NULL,
			 	'document_reference_no' => $data['document_reference_no'] ?? NULL,
			 	'billing_reference_no' => $data['billing_reference_no'] ?? NULL,
			 	'supplier_registration_name' => $data['supplier_registration_name'] ?? NULL,
			 	'supplier_phone' => $data['supplier_phone'] ?? NULL,
			 	'supplier_email' => $data['supplier_email'] ?? NULL,
			 	'supplier_tax_identification_no' => $data['supplier_tax_identification_no'] ?? NULL,
			 	'supplier_identification_no' => $data['supplier_identification_no'] ?? NULL,
			 	'supplier_identification_type' => $data['supplier_identification_type'] ?? NULL,
			 	'supplier_sst_registration_no' => $data['supplier_sst_registration_no'] ?? NULL,
			 	'supplier_msic_codes' => $data['supplier_msic_codes'] ?? NULL,
			 	'supplier_address_line_1' => $data['supplier_address_line_1'] ?? NULL,
			 	'supplier_address_line_2' => $data['supplier_address_line_2'] ?? NULL,
			 	'supplier_address_line_3' => $data['supplier_address_line_3'] ?? NULL,
			 	'supplier_city' => $data['supplier_city'] ?? NULL,
			 	'supplier_state' => $data['supplier_state'] ?? NULL,
			 	'supplier_postcode' => $data['supplier_postcode'] ?? NULL,
			 	'supplier_country_code' => $data['supplier_country_code'] ?? NULL,
			 	'customer_name' => $data['customer_name'] ?? NULL,
			 	'customer_email' => $data['customer_email'] ?? NULL,
			 	'customer_phone' => $data['customer_phone'] ?? NULL,
			 	'customer_tax_identification_no' => $data['customer_tax_identification_no'] ?? NULL,
			 	'customer_identification_no' => $data['customer_identification_no'] ?? NULL,
			 	'customer_identification_type' => $data['customer_identification_type'] ?? NULL,
			 	'customer_sst_registration_no' => $data['customer_sst_registration_no'] ?? NULL,
			 	'customer_address_line_1' => $data['customer_address_line_1'] ?? NULL,
			 	'customer_address_line_2' => $data['customer_address_line_2'] ?? NULL,
			 	'customer_address_line_3' => $data['customer_address_line_3'] ?? NULL,
			 	'customer_city' => $data['customer_city'] ?? NULL,
			 	'customer_state' => $data['customer_state'] ?? NULL,
			 	'customer_postcode' => $data['customer_postcode'] ?? NULL,
			 	'customer_country_code' => $data['customer_country_code'] ?? NULL,
			 	'total_net_amount' => $data['total_net_amount'] ?? NULL,
			 	'total_exclude_tax' => $data['total_exclude_tax'] ?? NULL,
			 	'total_include_tax' => $data['total_include_tax'] ?? NULL,
			 	'total_discount' => $data['total_discount'] ?? NULL,
			 	'total_charges' => $data['total_charges'] ?? NULL,
			 	'rounding_amount' => $data['rounding_amount'] ?? NULL,
			 	'payable_amount' => $data['payable_amount'] ?? NULL,
			 	'updated_at' => Carbon::now(),
			]
		);
	}
    
}
