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
        Schema::create('stinvoice_invoice_item_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('stinvoice_invoices_items_id')->nullable();
            $table->string('tax_type');
            $table->integer('unit')->default(1);
            $table->decimal('rate_per_unit',10,2);
            $table->decimal('tax_percent',10,2);
            $table->decimal('total_tax',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoice_item_taxes');
    }
};