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
        Schema::table('bookings', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('channel_id')->nullable()->after('agent_code');

            // If there's a foreign key relationship
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
            $table->dropForeign(['channel_id']);
            $table->dropColumn('channel_id');
        });
    }
};
