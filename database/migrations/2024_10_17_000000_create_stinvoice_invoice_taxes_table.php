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
        Schema::create('stinvoice_invoice_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('stinvoice_invoices_id')->nullable();
            $table->string('scheme');
            $table->string('category_id');
            $table->decimal('taxable_amount',10,2);
            $table->decimal('tax_amount',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoice_taxes');
    }
};