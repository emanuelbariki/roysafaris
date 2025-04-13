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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('agent');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('country_id')->nullable();
            $table->string('travel_month')->nullable();
            $table->string('travel_year')->nullable();
            $table->string('safari_ref')->nullable();
            $table->string('enquiry_status')->nullable();
            $table->string('enquiry_date')->nullable();
            $table->string('channel_id')->nullable();
            $table->text('comments')->nullable();
            $table->string('created_by')->nullable();
            $table->string('modified_by')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
