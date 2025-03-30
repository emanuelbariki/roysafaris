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
        Schema::create('park_special_fees', function (Blueprint $table) {
            $table->foreignId('park_id')->constrained('national_parks');
            $table->foreignId('special_fee_id')->constrained('special_fees');
            $table->text('notes')->nullable();
            
            $table->primary(['park_id', 'special_fee_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('park_special_fees');
    }
};
