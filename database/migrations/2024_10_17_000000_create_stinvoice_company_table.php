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
        Schema::create('stinvoice_company', function (Blueprint $table) {
            $table->id();
            $table->string('stinvoice_saas_id')->nullable();
            $table->string('registration_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('tax_identification_no')->nullable();
            $table->string('identification_no')->nullable();
            $table->string('identification_type')->nullable();
            $table->string('sst_registration_no')->default('NA')->nullable();
            $table->string('msic_codes')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country_code')->default('MYS');
            $table->string('stinvoice_key')->nullable();
            $table->string('stinvoice_secret')->nullable();
            $table->string('stinvoice_production')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stinvoice_company');
    }
};
