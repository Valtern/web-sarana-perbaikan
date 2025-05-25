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
         Schema::create('repairs', function (Blueprint $table) {
            $table->id('repair_ID');
            $table->unsignedBigInteger('facility_report_id');
            $table->unsignedBigInteger('technician_id');
            $table->unsignedBigInteger('priority_Assignment')->nullable();
            $table->enum('repair_status', ['Not_started', 'In_progress', 'Completed'])->default('Not_started');
            $table->string('notes', 200)->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('facility_report_id')->references('report_ID')->on('report');
            $table->foreign('technician_id')->references('id')->on('users');
            $table->foreign('priority_Assignment')->references('priority_Assignment_ID')->on('priority_assignment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
