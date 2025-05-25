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
        Schema::create('report', function (Blueprint $table) {
            $table->id('report_ID');
            $table->unsignedBigInteger('user_ID');
            $table->unsignedBigInteger('priority_Assignment')->nullable();
            $table->string('facility_name', 50);
            $table->string('location', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->enum('category', ['Electronic', 'Table', 'Chair', 'Desk', 'Computer', 'Miscellaneous']);
            $table->string('picture_proof', 200)->nullable();
            $table->enum('status', ['Declined', 'Pending', 'In_progress', 'Solved'])->default('Pending');
            $table->timestamps();

            $table->foreign('user_ID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
