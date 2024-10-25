<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceItemCommodity
{
	public $stinvoice_invoices_item_id;

	public function __construct($stinvoice_invoices_item_id)
    {
        $this->stinvoice_invoices_item_id = $stinvoice_invoices_item_id;
    }

	public function getDetails(){

		$commodities = DB::table('stinvoice_invoice_item_commodity')
					 ->where('stinvoice_invoices_items_id',$this->stinvoice_invoices_item_id)
					 ->get();

		return $commodities;
	}

	public function saveDetails($datas){

		foreach($datas as $data){

			DB::table('stinvoice_invoice_item_commodity')
			->insert(
				[
				 	'stinvoice_invoices_items_id' => $this->stinvoice_invoices_item_id,
				 	'code' => $data['code'] ?? NULL,
				 	'code_attribute' => $data['code_attribute'] ?? NULL,
				 	'created_at' => Carbon::now(),
				]
			);
		}
	}
    
}
