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
        Schema::create('facility', function (Blueprint $table) {
            $table->id('facility_ID');
            $table->string('name', 50);
            $table->enum('type', ['Electronic', 'Table', 'Chair', 'Desk', 'Computer', 'Miscellaneous']);
            $table->unsignedBigInteger('building_ID');
            $table->enum('status', ['Good', 'Fine', 'Damaged'])->default('Good');

            $table->foreign('building_ID')->references('building_ID')->on('building');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility');
    }
};
