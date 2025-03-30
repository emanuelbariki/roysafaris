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
        Schema::create('special_fees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('location', 100)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('visitor_category_id')->nullable()->constrained('visitor_categories', 'id');
            $table->foreignId('age_group_id')->nullable()->constrained('age_groups');
            $table->foreignId('currency_id')->constrained('currencies');
            $table->decimal('amount', 10, 2);
            $table->decimal('vat_rate', 5, 2)->default(18.00);
            $table->boolean('is_vat_inclusive')->default(false);
            $table->boolean('is_one_time_fee')->default(false);
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
        Schema::dropIfExists('special_fees');
    }
};
