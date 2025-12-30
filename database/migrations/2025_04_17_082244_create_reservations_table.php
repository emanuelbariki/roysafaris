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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->foreignId('lodge_id')->constrained()->onDelete('cascade');
            $table->string('booking_code')->nullable();
            $table->date('arrival');
            $table->date('departure');
            $table->integer('nights');
            $table->time('arrival_time')->nullable();
            $table->string('total_pax')->nullable();
            $table->string('total_rooms')->nullable();
            $table->string('current_version')->nullable();
            $table->date('voucher_issue_date')->nullable();
            $table->date('issue_date')->nullable();
            $table->string('prior_version')->nullable();
            $table->string('lodge_code')->nullable();
            $table->string('property_name')->nullable();
            $table->unsignedInteger('adults')->default(0);
            $table->unsignedInteger('children')->default(0);
            $table->unsignedInteger('juniors')->default(0);
            $table->unsignedInteger('infants')->default(0);
            // $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->boolean('day_room')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('booking_date')->nullable();
            $table->string('internal_ref')->nullable();
            $table->string('reservation_code')->nullable();
            $table->json('room_detail')->nullable();
            $table->text('guest_notes')->nullable();
            $table->text('internal_remarks')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
