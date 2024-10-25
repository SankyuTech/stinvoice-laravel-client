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
        Schema::create('stinvoice_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->integer('stinvoice_invoices_id')->nullable();
            $table->string('description');
            $table->decimal('unit_price',10,2);
            $table->integer('quantity')->default(1);
            $table->decimal('subtotal',10,2);
            $table->decimal('tax_total',10,2);
            $table->string('country_code')->default('MYS');
            $table->decimal('discount_percentage',10,2);
            $table->decimal('total_discount',10,2);
            $table->string('discount_description');
            $table->decimal('charges_percentage',10,2);
            $table->decimal('total_charges',10,2);
            $table->string('charges_description');
            $table->decimal('amount_exempted_from_tax',10,2)->default('0');
            $table->decimal('amount_of_tax_exempted',10,2)->default('0');
            $table->string('details_of_tax_exemption');
            $table->decimal('total_excluding_tax_amount',10,2)->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoice_items');
    }
};
