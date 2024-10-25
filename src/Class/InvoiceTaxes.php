<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceTaxes
{
	public $stinvoice_invoices_id;

	public function __construct($stinvoice_invoices_id)
    {
        $this->stinvoice_invoices_id = $stinvoice_invoices_id;
    }

	public function getDetails(){

		$details = DB::table('stinvoice_invoice_taxes')
					 ->where('stinvoice_invoices_id',$this->stinvoice_invoices_id)
					 ->get();

		return $details;
	}

	public function saveDetails($datas){

		foreach($datas as $data){

			DB::table('stinvoice_invoices')
			->insert(
				[
				 	'stinvoice_invoices_id' => $this->stinvoice_invoices_id,
				 	'scheme' => $data['scheme'] ?? NULL,
				 	'category_id' => $data['category_id'] ?? NULL,
				 	'taxable_amount' => $data['taxable_amount'] ?? NULL,
				 	'tax_amount' => $data['tax_amount'] ?? NULL,
				 	'updated_at' => Carbon::now(),
				]
			);
		}
	}
    
}
