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
        Schema::create('equiry_details', function (Blueprint $table) {
            $table->id();
            $table->text('tour_interests')->comment('will store interests in a json');
            $table->text('age_groups')->comment('will store age gourps in a json');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equiry_details');
    }
};
