<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create alternative_topsis table
Schema::create('alternative_topsis', function (Blueprint $table) {
    $table->id('id_alternative'); // primary key
    $table->string('alternative', 100);

    // Add this line to reference report_ID in the report table
    $table->unsignedBigInteger('report_id'); // or 'report_ID' to match report table exactly

    $table->foreign('report_id')
          ->references('report_ID')  // the column in the 'report' table
          ->on('report')             // name of the table
          ->onDelete('cascade');
});

        // Create criteria_topsis table
        Schema::create('criteria_topsis', function (Blueprint $table) {
            $table->id('criteria_topsis_id'); // unsigned BIGINT by default
            $table->string('criteria_name', 100)->notNull();
            $table->float('weight')->notNull();
            $table->enum('type', ['max', 'min']);
        });
// Create sample_topsis table with matching foreign key types
Schema::create('sample_topsis', function (Blueprint $table) {
    $table->id('id_sample');
    $table->unsignedBigInteger('id_alternative');
    $table->unsignedBigInteger('id_criteria');
    $table->float('value');

    // Foreign key constraints
    $table->foreign('id_alternative')
          ->references('id_alternative')
          ->on('alternative_topsis')
          ->onDelete('cascade');

    $table->foreign('id_criteria')
          ->references('criteria_topsis_id')
          ->on('criteria_topsis')
          ->onDelete('cascade');
});
    }

    public function down()
    {
        Schema::dropIfExists('sample_topsis');
        Schema::dropIfExists('criteria_topsis');
        Schema::dropIfExists('alternative_topsis');
    }
};
