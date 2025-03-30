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
        Schema::create('park_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('national_park_id')->constrained('national_parks');
            $table->foreignId('fee_type_id')->constrained('fee_types');
            $table->foreignId('visitor_category_id')->constrained('visitor_categories', 'id');
            $table->foreignId('age_group_id')->constrained('age_groups');
            $table->foreignId('season_id')->constrained('seasons');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();
            $table->decimal('vat_rate', 5, 2)->default(18.00);
            $table->boolean('is_vat_inclusive')->default(false);
            $table->string('is_one_time_fee')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('park_fees');
    }
};
