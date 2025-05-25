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
        Schema::create('building', function (Blueprint $table) {
            $table->id('building_ID');
            $table->string('name', 50);
            $table->string('location', 50)->nullable();
            $table->enum('status', ['Good', 'Fine', 'Damaged'])->default('Good');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building');
    }
};
