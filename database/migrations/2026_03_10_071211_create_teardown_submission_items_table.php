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
       Schema::create('teardown_submission_items', function (Blueprint $table) {
    $table->id();

    $table->foreignId('teardown_submission_id')
        ->constrained('teardown_submissions')
        ->cascadeOnDelete();

    $table->foreignId('teardown_log_id')
        ->constrained('teardown_logs')
        ->cascadeOnDelete();

    $table->timestamps();

    $table->unique(['teardown_submission_id', 'teardown_log_id'], 'tsi_submission_log_unique');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teardown_submission_items');
    }
};
