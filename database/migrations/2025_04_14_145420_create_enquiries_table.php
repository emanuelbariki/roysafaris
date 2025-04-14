<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('mobile')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->enum('flexible_dates', ['yes', 'no']);
            $table->integer('adults');
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->integer('juniors')->default(0);
            $table->text('special_interests')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('referral_source')->nullable();
            $table->text('comments')->nullable();
            $table->enum('status', ['enquiry', 'followup', 'confirmed', 'cancelled'])->default('enquiry');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('draft')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}