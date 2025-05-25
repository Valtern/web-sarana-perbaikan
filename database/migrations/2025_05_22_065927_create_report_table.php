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
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('priority_Assignment')->nullable();
            $table->string('facility_name', 50);
            $table->string('location', 200)->nullable();
            $table->string('description', 200)->nullable();
            $table->enum('category', ['Electronic', 'Table', 'Chair', 'Desk', 'Computer', 'Miscellaneous']);
            $table->string('picture_proof', 200)->nullable();
            $table->enum('status', ['Declined', 'Pending', 'In_progress', 'Solved'])->default('Pending');
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users');
            $table->foreign('priority_Assignment')->references('priority_Assignment_ID')->on('priority_assignment');
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
