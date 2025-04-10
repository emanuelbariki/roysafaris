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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->string('group_name');
            $table->string('nationality');
            $table->text('remarks')->nullable();
            $table->string('file_owner')->nullable();
            $table->string('agent_code')->nullable();
            $table->string('booking_code');
            $table->dateTime('arrival_date');
            $table->dateTime('departure_date');
            $table->string('pickup_details')->nullable();
            $table->string('drop_details')->nullable();
            $table->integer('adults')->default(0);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->integer('rooms')->default(0);
            $table->json('services')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
