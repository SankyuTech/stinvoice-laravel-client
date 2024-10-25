<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

	public function saveCredential($data){

		DB::table('stinvoice_company')
		->updateOrInsert(
			[
				'internal_reference_id' => $this->internal_reference_id
			],
			[
			 	'stinvoice_key' => $data['stinvoice_key'] ?? NULL,
			 	'stinvoice_secret' => $data['stinvoice_secret'] ?? NULL,
			 	'stinvoice_production' => $data['stinvoice_production'] ?? false,
			 	'status' => $data['status'] ?? false,
			 	'updated_at' => Carbon::now(),
			]
		);
	}
    
}
