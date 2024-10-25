<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceAllowanceCharges
{
	public $stinvoice_invoices_id;

	public function __construct($stinvoice_invoices_id)
    {
        $this->stinvoice_invoices_id = $stinvoice_invoices_id;
    }

	public function getDetails(){

		$details = DB::table('stinvoice_invoice_allowance_charges')
					 ->where('stinvoice_invoices_id',$this->stinvoice_invoices_id)
					 ->get();

		return $details;
	}

	public function saveDetails($datas){

		foreach($datas as $data){

			DB::table('stinvoice_invoice_allowance_charges')
			->insert(
				[
				 	'stinvoice_invoices_id' => $this->stinvoice_invoices_id,
				 	'type' => $data['type'] ?? NULL,
				 	'reason' => $data['reason'] ?? NULL,
				 	'percentage' => $data['percentage'] ?? NULL,
				 	'amount' => $data['amount'] ?? NULL,
				 	'updated_at' => Carbon::now(),
				]
			);
		}
	}
    
}