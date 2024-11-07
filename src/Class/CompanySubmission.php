<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySubmission
{
	public $company_reference_id;

	public function __construct($company_reference_id)
    {
        $this->company_reference_id = $company_reference_id;
    }

    public function getAllSubmissions(){

    	$submissions = DB::table('stinvoice_submission')
					 ->where('stinvoice_company_id',$this->company_reference_id)
					 ->get();

		return $submissions;
    }

	public function getSubmission($internal_reference_id,$reference_no){

    	$submission = DB::table('stinvoice_submission')
					 ->where('stinvoice_company_id',$this->company_reference_id)
					 ->where('internal_reference_id',$internal_reference_id)
					 ->where('reference_no',$reference_no)
					 ->first();

		return $submission;
	}

	public function getInvoiceSubmissionHistory($einvoice_submission_uuid){

    	$submissionHistories = DB::table('stinvoice_submission')
					 ->where('stinvoice_company_id',$this->company_reference_id)
					 ->where('einvoice_submission_uuid',$einvoice_submission_uuid)
					 ->get();

		return $submissionHistories;
	}

	public function saveSubmission($data){

		$company = DB::table('stinvoice_company')
					->where('internal_reference_id',$this->internal_reference_id)
					 ->first();

		DB::table('stinvoice_company')
		->insert(
			[
			 	'stinvoice_company_id' => $company->id,
			 	'internal_reference_id' => $data['internal_reference_id'] ?? NULL,
			 	'reference_no' => $data['reference_no'] ?? false,
			 	'einvoice_submission_uuid' => $data['einvoice_submission_uuid'] ?? NULL,
			 	'einvoice_submission_invoice_uuid' => $data['einvoice_submission_invoice_uuid'] ?? NULL,
			 	'einvoice_validation_link' => $data['einvoice_validation_link'] ?? NULL,
			 	'einvoice_submission_invoice_long_uuid' => $data['einvoice_submission_invoice_long_uuid'] ?? NULL,
			 	'einvoice_submission_timestamp' => $data['einvoice_submission_timestamp'] ?? NULL,
			 	'document_type' => $data['document_type'] ?? false,
			 	'stinvoice_sandbox' => $data['stinvoice_sandbox'] ?? 1,
			 	'raw_submission' => $data['raw_submission'] ?? NULL,
			 	'response' => $data['response'] ?? NULL,
			 	'status' => $data['status'] ?? 1,
			 	'created_at' => Carbon::now(),
			]
		);
	}
    
}