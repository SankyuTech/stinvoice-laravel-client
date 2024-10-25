<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceItemTaxes
{
	public $stinvoice_invoices_item_id;

	public function __construct($stinvoice_invoices_item_id)
    {
        $this->stinvoice_invoices_item_id = $stinvoice_invoices_item_id;
    }

	public function getDetails(){

		$taxes = DB::table('stinvoice_invoice_item_taxes')
					 ->where('stinvoice_invoices_items_id',$this->stinvoice_invoices_item_id)
					 ->get();

		return $taxes;
	}

	public function saveDetails($datas){

		foreach($datas as $data){

			DB::table('stinvoice_invoice_item_taxes')
			->insert(
				[
				 	'stinvoice_invoices_items_id' => $this->stinvoice_invoices_item_id,
				 	'tax_type' => $data['tax_type'] ?? NULL,
				 	'unit' => $data['unit'] ?? NULL,
				 	'rate_per_unit' => $data['rate_per_unit'] ?? NULL,
				 	'tax_percent' => $data['tax_percent'] ?? NULL,
				 	'total_tax' => $data['total_tax'] ?? NULL,
				 	'updated_at' => Carbon::now(),
				]
			);
		}
	}
    
}
