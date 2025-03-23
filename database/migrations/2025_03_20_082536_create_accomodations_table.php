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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_chain_id')->nullable();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('accommodations_type_id');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->string('camping_logistics')->nullable();
            $table->string('balloon_pickup');
            $table->string('voucher_copies');
            $table->string('pay_to');
            $table->string('billing_ccy');
            $table->string('coordinates');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acoomodations');
    }
};
