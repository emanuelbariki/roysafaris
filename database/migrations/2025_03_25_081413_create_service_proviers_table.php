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
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('parent_company_id')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('address');
            $table->string('city_id');
            $table->string('country_id');
            $table->string('type')->comment('Agent,Baloon Company etc');
            $table->string('voucher_copies')->default('3');
            $table->string('bill_to')->default('service_provider');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_proviers');
    }
};
