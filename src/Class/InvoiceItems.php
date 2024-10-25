<?php

namespace Sankyutech\StInvoiceClient\Class;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InvoiceItems
{
	public $stinvoice_invoices_id;

	public function __construct($stinvoice_invoices_id)
    {
        $this->stinvoice_invoices_id = $stinvoice_invoices_id;
    }

	public function getDetails(){

		$items = DB::table('stinvoice_invoice_items')
					 ->where('stinvoice_invoices_id',$this->stinvoice_invoices_id)
					 ->get();

		return $items;
	}

	public function saveDetails($datas){

		foreach($datas as $data){

			DB::table('stinvoice_invoice_items')
			->insert(
				[
				 	'stinvoice_invoices_id' => $this->stinvoice_invoices_id,
				 	'description' => $data['description'] ?? NULL,
				 	'quantity' => $data['quantity'] ?? NULL,
				 	'subtotal' => $data['subtotal'] ?? NULL,
				 	'tax_total' => $data['tax_total'] ?? NULL,
				 	'country_code' => $data['country_code'] ?? NULL,
				 	'discount_percentage' => $data['discount_percentage'] ?? NULL,
				 	'total_discount' => $data['total_discount'] ?? NULL,
				 	'discount_description' => $data['discount_description'] ?? NULL,
				 	'charges_percentage' => $data['charges_percentage'] ?? NULL,
				 	'total_charges' => $data['total_charges'] ?? NULL,
				 	'charges_description' => $data['charges_description'] ?? NULL,
				 	'amount_exempted_from_tax' => $data['amount_exempted_from_tax'] ?? NULL,
				 	'amount_of_tax_exempted' => $data['amount_of_tax_exempted'] ?? NULL,
				 	'details_of_tax_exemption' => $data['details_of_tax_exemption'] ?? NULL,
				 	'total_excluding_tax_amount' => $data['total_excluding_tax_amount'] ?? NULL,
				 	'updated_at' => Carbon::now(),
				]
			);
		}
	}
    
}
