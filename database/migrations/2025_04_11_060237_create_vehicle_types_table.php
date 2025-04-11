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
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('seating')->nullable();
            $table->string('transmission')->nullable();
            $table->string('drive')->nullable();
            $table->string('fuel')->nullable();
            $table->boolean('ac')->default(false);
            $table->decimal('rate', 10, 2)->nullable();
            $table->string('status')->default('available');
            $table->date('available_from')->nullable();
            $table->date('available_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};
