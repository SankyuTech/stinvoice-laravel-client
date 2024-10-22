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
            $table->string('stinvoice_saas_id')->nullable();
            $table->string('internal_id');
            $table->integer('stinvoice_company_id')->nullable();
            $table->string('document_reference_no');
            $table->string('billing_reference_no');
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->string('tax_identification_no');
            $table->string('identification_no');
            $table->string('identification_type');
            $table->string('sst_registration_no')->default('NA');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('country_code')->default('MYS');
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