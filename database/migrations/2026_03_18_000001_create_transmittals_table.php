<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transmittals', function (Blueprint $table) {
            $table->id();

            // Auto-generated reference number e.g. TRF-20260318-001
            $table->string('transmittal_number')->unique();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            // Who requested the pullout (warehouse incharge / subcon)
            $table->foreignId('requested_by')
                ->constrained('users')
                ->cascadeOnDelete();

            // Who approved/rejected (PM or admin)
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Origin and destination warehouses (FK)
            $table->foreignId('origin_warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            $table->foreignId('destination_warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            // Driver and truck info for documentation
            $table->string('driver_name');
            $table->string('truck_plate');
            $table->string('driver_contact')->nullable();

            $table->text('reason')->nullable();
            $table->text('rejection_reason')->nullable();

            // pending | approved | rejected | in_transit | completed | cancelled
            $table->string('status')->default('pending');

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transmittals');
    }
};
