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
        Schema::create('damage_report', function (Blueprint $table) {
            $table->id('damage_report_ID');
            $table->unsignedBigInteger('facility_ID');
            $table->integer('total_report')->default(0);
            $table->string('frequent_damaged_facility', 200)->nullable();
            $table->string('frequent_total_damage', 50)->nullable();

            $table->foreign('facility_ID')->references('facility_ID')->on('facility');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_report');
    }
};
