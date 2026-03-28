<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teardown_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('node_id')
                ->constrained('nodes')
                ->cascadeOnDelete();

            $table->foreignId('pole_span_id')
                ->constrained('pole_spans')
                ->cascadeOnDelete();

            $table->string('team')->nullable();
            $table->string('status')->default('submitted');
            // submitted, reviewed, approved, rejected

            $table->boolean('did_collect_all_cable')->default(true);
            $table->decimal('collected_cable', 10, 2)->default(0);
            $table->decimal('unrecovered_cable', 10, 2)->default(0);
            $table->text('unrecovered_reason')->nullable();
            $table->string('unrecovered_image')->nullable();

            $table->boolean('did_collect_components')->default(false);

            $table->integer('collected_node')->default(0);
            $table->integer('collected_amplifier')->default(0);
            $table->integer('collected_extender')->default(0);
            $table->integer('collected_tsc')->default(0);
            $table->integer('collected_powersupply')->default(0);
            $table->integer('collected_powersupply_housing')->default(0);

            $table->decimal('expected_cable_snapshot', 10, 2)->default(0);
            $table->integer('expected_node_snapshot')->default(0);
            $table->integer('expected_amplifier_snapshot')->default(0);
            $table->integer('expected_extender_snapshot')->default(0);
            $table->integer('expected_tsc_snapshot')->default(0);
            $table->integer('expected_powersupply_snapshot')->default(0);
            $table->integer('expected_powersupply_housing_snapshot')->default(0);

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->string('submitted_by')->nullable();

            // GPS / audit fields
            $table->decimal('captured_latitude', 10, 7)->nullable();
            $table->decimal('captured_longitude', 10, 7)->nullable();
            $table->decimal('gps_accuracy_meters', 8, 2)->nullable();

            $table->timestamp('captured_at_device')->nullable();
            $table->timestamp('received_at_server')->nullable();
            $table->timestamp('synced_at_server')->nullable();

            $table->string('gps_source')->nullable();
            // device_gps, exif, manual, cached, pole_map_fallback

            $table->boolean('offline_mode')->default(false);
            $table->text('location_notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teardown_logs');
    }
};