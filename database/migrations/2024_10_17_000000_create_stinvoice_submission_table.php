<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stinvoice_submission', function (Blueprint $table) {
            $table->id();
            $table->string('stinvoice_company_id')->nullable();
            $table->string('internal_reference_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('einvoice_submission_uuid')->nullable();
            $table->string('einvoice_submission_invoice_uuid')->nullable();
            $table->string('einvoice_submission_invoice_long_uuid')->nullable();
            $table->string('einvoice_submission_timestamp')->nullable();
            $table->string('einvoice_validation_link')->nullable();
            $table->string('document_type')->nullable();
            $table->boolean('stinvoice_sandbox')->default(1);
            $table->longText('stinvoice_parameter_structure')->nullable();
            $table->longText('raw_submission')->nullable();
            $table->longText('response')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_submission');
    }
};
