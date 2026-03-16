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
       Schema::create('submission_remarks', function (Blueprint $table) {
    $table->id();

    $table->foreignId('teardown_submission_id')
        ->constrained('teardown_submissions')
        ->cascadeOnDelete();

    $table->foreignId('teardown_log_id')
        ->nullable()
        ->constrained('teardown_logs')
        ->nullOnDelete();

    $table->foreignId('pole_id')
        ->nullable()
        ->constrained('poles')
        ->nullOnDelete();

    $table->string('from_role');
    // lineman, team_pm, telcovantage, warehouse

    $table->string('from_user')->nullable();

    $table->string('action')->default('comment');
    // comment, returned_for_rework, approved, edited, resubmitted

    $table->text('remarks');

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_remarks');
    }
};
