<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transmittal_id')
                ->nullable()
                ->constrained('transmittals')
                ->nullOnDelete();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->foreignId('driver_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('driver_name');
            $table->string('truck_plate');
            $table->string('driver_contact')->nullable();

            // FK to warehouses
            $table->foreignId('origin_warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            $table->foreignId('destination_warehouse_id')
                ->constrained('warehouses')
                ->cascadeOnDelete();

            // draft | in_transit | arrived | received | cancelled
            $table->string('status')->default('draft');

            $table->string('departure_photo')->nullable();
            $table->string('arrival_photo')->nullable();

            $table->timestamp('departed_at')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('received_at')->nullable();

            // Last known GPS (fast lookup for map)
            $table->decimal('last_latitude', 10, 7)->nullable();
            $table->decimal('last_longitude', 10, 7)->nullable();
            $table->timestamp('last_location_at')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
