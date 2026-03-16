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
       Schema::create('teardown_submissions', function (Blueprint $table) {
    $table->id();

    $table->foreignId('project_id')->constrained()->cascadeOnDelete();
    $table->foreignId('node_id')->constrained()->cascadeOnDelete();

    $table->date('report_date');
    $table->string('team')->nullable();

    $table->string('status')->default('draft');
    // draft, submitted_to_pm, pm_for_rework, pm_approved,
    // submitted_to_telcovantage, telcovantage_for_rework,
    // telcovantage_approved, ready_for_delivery, delivered, closed

    $table->decimal('total_cable', 12, 2)->default(0);
    $table->integer('total_node')->default(0);
    $table->integer('total_amplifier')->default(0);
    $table->integer('total_extender')->default(0);
    $table->integer('total_tsc')->default(0);

    $table->string('item_status')->default('onfield');
    // onfield, ongoing_delivery, delivered, delivery_onhold

    $table->string('warehouse_location')->nullable();

    $table->string('entry_mode')->default('reported');
    // reported, manual

    $table->text('manual_reason')->nullable();
    $table->string('manually_added_by')->nullable();

    $table->string('submitted_by')->nullable();
    $table->timestamp('submitted_at')->nullable();

    $table->string('pm_reviewed_by')->nullable();
    $table->timestamp('pm_reviewed_at')->nullable();

    $table->string('telcovantage_reviewed_by')->nullable();
    $table->timestamp('telcovantage_reviewed_at')->nullable();

    $table->integer('revision_no')->default(0);

    $table->decimal('gps_center_latitude', 10, 7)->nullable();
$table->decimal('gps_center_longitude', 10, 7)->nullable();

$table->decimal('gps_min_latitude', 10, 7)->nullable();
$table->decimal('gps_max_latitude', 10, 7)->nullable();

$table->decimal('gps_min_longitude', 10, 7)->nullable();
$table->decimal('gps_max_longitude', 10, 7)->nullable();

$table->integer('gps_log_count')->default(0);
$table->boolean('has_offline_logs')->default(false);
$table->text('gps_summary_notes')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teardown_submissions');
    }
};
