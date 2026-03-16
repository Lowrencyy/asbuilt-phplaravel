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
        Schema::create('warehouse_receipts', function (Blueprint $table) {
    $table->id();

    $table->string('warehouse_receipt_id')->unique();

    $table->foreignId('teardown_submission_id')
        ->nullable()
        ->constrained('teardown_submissions')
        ->nullOnDelete();

    $table->foreignId('project_id')
        ->constrained('projects')
        ->cascadeOnDelete();

    $table->foreignId('node_id')
        ->constrained('nodes')
        ->cascadeOnDelete();

    $table->date('delivery_date')->nullable();
    $table->date('teardown_date')->nullable();

    $table->text('pole_source')->nullable();
    // comma-separated or JSON list of pole codes

    $table->decimal('collected_cable', 12, 2)->default(0);
    $table->integer('collected_node')->default(0);
    $table->integer('collected_amplifier')->default(0);
    $table->integer('collected_extender')->default(0);
    $table->integer('collected_tsc')->default(0);

    $table->string('delivery_proof')->nullable();

    $table->string('warehouse_location')->nullable();
    $table->string('status')->default('pending_delivery');
    // pending_delivery, in_transit, received, onhold, transferred

    $table->string('entry_mode')->default('reported');
    // reported, manual

    $table->text('manual_reason')->nullable();
    $table->string('manually_added_by')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_receipts');
    }
};
