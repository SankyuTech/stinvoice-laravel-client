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
        Schema::create('stinvoice_company', function (Blueprint $table) {
            $table->id();
            $table->string('stinvoice_saas_id')->nullable();
            $table->integer('registration_name')->nullable();
            $table->string('phone');
            $table->string('tax_identification_no');
            $table->string('identification_no');
            $table->string('identification_type');
            $table->string('sst_registration_no')->default('NA');
            $table->string('msic_codes');
            $table->string('address_line_1');
            $table->string('address_line_2');
            $table->string('address_line_3');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
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