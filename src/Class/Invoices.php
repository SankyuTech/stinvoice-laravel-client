<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Invoices
{
	public $company_reference_id;

	public function __construct($company_reference_id)
    {
        $this->company_reference_id = $company_reference_id;
    }

	public function getInvoice($stinvoice_submission_id){

		$invoice = DB::table('stinvoice_invoices')
					 ->where('stinvoice_submission_id',$stinvoice_submission_id)
					 ->first();

		return $invoice;
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
