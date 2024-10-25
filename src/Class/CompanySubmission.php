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

		DB::table('stinvoice_company')
		->insert(
			[
			 	'stinvoice_company_id' => $data['stinvoice_company_id'] ?? NULL,
			 	'internal_reference_id' => $data['internal_reference_id'] ?? NULL,
			 	'reference_no' => $data['reference_no'] ?? false,
			 	'document_type' => $data['document_type'] ?? false,
			 	'updated_at' => Carbon::now(),
			]
		);
	}
    
}
