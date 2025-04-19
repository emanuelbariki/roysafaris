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
        Schema::create('pickup_dropoff_points', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('country_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('cordinates')->nullable();
            $table->string('transport_mode')->default('land');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_dropoff_points');
    }
};
