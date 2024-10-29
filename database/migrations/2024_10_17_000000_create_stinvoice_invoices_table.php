<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stinvoice_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('ulid');
            $table->string('stinvoice_submission_id')->nullable();
            $table->integer('stinvoice_company_id')->nullable();
            $table->string('document_reference_no');
            $table->string('billing_reference_no');
            $table->string('supplier_registration_name')->nullable();
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_email')->nullable();
            $table->string('supplier_tax_identification_no')->nullable();
            $table->string('supplier_identification_no')->nullable();
            $table->string('supplier_identification_type')->nullable();
            $table->string('supplier_sst_registration_no')->default('NA')->nullable();
            $table->string('supplier_msic_codes')->nullable();
            $table->string('supplier_address_line_1')->nullable();
            $table->string('supplier_address_line_2')->nullable();
            $table->string('supplier_address_line_3')->nullable();
            $table->string('supplier_city')->nullable();
            $table->string('supplier_state')->nullable();
            $table->string('supplier_postcode')->nullable();
            $table->string('supplier_country_code')->default('MYS');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('customer_tax_identification_no');
            $table->string('customer_identification_no');
            $table->string('customer_identification_type');
            $table->string('customer_sst_registration_no')->default('NA');
            $table->string('customer_address_line_1');
            $table->string('customer_address_line_2');
            $table->string('customer_address_line_3');
            $table->string('customer_city');
            $table->string('customer_state');
            $table->string('customer_postcode');
            $table->string('customer_country_code')->default('MYS');
            $table->string('delivery_registration_name')->nullable();
            $table->string('delivery_tax_identification_no')->nullable();
            $table->string('delivery_identification_no')->nullable();
            $table->string('delivery_identification_type')->nullable();
            $table->string('delivery_address_line_1')->nullable();
            $table->string('delivery_address_line_2')->nullable();
            $table->string('delivery_address_line_3')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_state')->nullable();
            $table->string('delivery_postcode')->nullable();
            $table->string('delivery_country_code')->default('MYS');
            $table->decimal('delivery_charges_amount',10,2)->nullable();
            $table->string('delivery_charges_reason')->nullable();
            $table->decimal('delivery_charges_percentage',10,2)->nullable();
            $table->string('delivery_charges_shipment_id')->nullable();
            $table->string('prepaid_payment_id')->nullable();
            $table->decimal('prepaid_payment_amount',10,2)->nullable();
            $table->string('prepaid_payment_timestamp')->nullable();
            $table->string('payment_means_payment_mode_code')->nullable();
            $table->string('payment_means_supplier_account_bank')->nullable();
            $table->string('invoice_period_start_date')->nullable();
            $table->string('invoice_period_end_date')->nullable();
            $table->string('invoice_period_billing_frequency')->nullable();
            $table->string('additional_document_reference_customs_import_form_reference_no')->nullable();
            $table->string('additional_document_reference_free_trade_agreement_id')->nullable();
            $table->string('additional_document_reference_free_trade_agreement_description')->nullable();
            $table->string('additional_document_reference_customs_import_form_2_id')->nullable();
            $table->string('additional_document_reference_incoterms_id')->nullable();
            $table->decimal('total_net_amount',10,2)->default('0');
            $table->decimal('total_exclude_tax',10,2)->default('0');
            $table->decimal('total_include_tax',10,2)->default('0');
            $table->decimal('total_discount',10,2)->default('0');
            $table->decimal('total_charges',10,2)->default('0');
            $table->decimal('rounding_amount',10,2)->default('0');
            $table->decimal('payable_amount',10,2)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoices');
    }
};