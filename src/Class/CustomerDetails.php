<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerDetails
{
	public $internal_reference_id;

	public function __construct($internal_reference_id)
    {
        $this->internal_reference_id = $internal_reference_id;
    }

	public function getDetail(){

		$credential = DB::table('stinvoice_company')
					 ->select(
					 	'registration_name',
					 	'phone',
					 	'email',
					 	'tax_identification_no',
					 	'identification_no',
					 	'identification_type',
					 	'sst_registration_no',
					 	'msic_codes',
					 	'address_line_1',
					 	'address_line_2',
					 	'address_line_3',
					 	'city',
					 	'state',
					 	'postcode',
					 	'country_code'
					 )
					 ->where('internal_reference_id',$this->internal_reference_id)
					 ->first();

		return $credential;
	}

	public function saveDetail($data){

		DB::table('stinvoice_company')
		->updateOrInsert(
			[
				'internal_reference_id' => $this->internal_reference_id
			],
			[
			 	'registration_name' => $data['registration_name'] ?? NULL,
			 	'phone' => $data['phone'] ?? NULL,
			 	'email' => $data['email'] ?? NULL,
			 	'tax_identification_no' => $data['tax_identification_no'] ?? NULL,
			 	'identification_no' => $data['identification_no'] ?? NULL,
			 	'identification_type' => $data['identification_type'] ?? NULL,
			 	'msic_codes' => $data['msic_codes'] ?? NULL,
			 	'address_line_1' => $data['address_line_1'] ?? NULL,
			 	'address_line_2' => $data['address_line_2'] ?? NULL,
			 	'address_line_3' => $data['address_line_3'] ?? NULL,
			 	'city' => $data['city'] ?? NULL,
			 	'postcode' => $data['postcode'] ?? NULL,
			 	'country_code' => $data['country_code'] ?? NULL,
			 	'updated_at' => Carbon::now(),
			]
		);
	}
    
}
