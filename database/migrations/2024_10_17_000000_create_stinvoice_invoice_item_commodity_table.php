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
        Schema::create('stinvoice_invoice_item_commodity', function (Blueprint $table) {
            $table->id();
            $table->integer('stinvoice_invoices_items_id')->nullable();
            $table->string('code');
            $table->string('code_attribute');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoice_item_commodity');
    }
};
