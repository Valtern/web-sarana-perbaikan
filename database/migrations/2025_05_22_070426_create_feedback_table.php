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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_ID');
            $table->unsignedBigInteger('repairs_ID');
            $table->unsignedBigInteger('submitted_by');
            $table->string('feedback_content', 500)->nullable();
            $table->integer('rate');
            $table->foreign('repairs_ID')->references('repair_ID')->on('repairs');
            $table->foreign('submitted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
