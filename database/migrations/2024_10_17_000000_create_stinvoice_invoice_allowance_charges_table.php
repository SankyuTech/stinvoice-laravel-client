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
        Schema::create('stinvoice_invoice_allowance_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('stinvoice_invoices_id')->nullable();
            $table->integer('type')->comment('1-charges, 2-discount');
            $table->string('reason');
            $table->decimal('percentage',10,2)->nullable();
            $table->decimal('amount',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_invoice_allowance_charges');
    }
};