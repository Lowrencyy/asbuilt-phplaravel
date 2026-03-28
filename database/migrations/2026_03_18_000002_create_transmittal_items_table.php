<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transmittal_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transmittal_id')
                ->constrained('transmittals')
                ->cascadeOnDelete();

            // Optional — which node did this item come from
            $table->foreignId('node_id')
                ->nullable()
                ->constrained('nodes')
                ->nullOnDelete();

            // wire | amplifier | extender | tsc | powersupply | powersupply_housing | node_device | other
            $table->string('item_type');
            $table->string('item_description')->nullable(); // free text for "other"
            $table->string('unit')->default('pcs'); // pcs | meters

            $table->decimal('quantity_requested', 12, 2);
            $table->decimal('quantity_approved', 12, 2)->nullable(); // PM can adjust
            $table->decimal('quantity_received', 12, 2)->nullable(); // filled on delivery receipt

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transmittal_items');
    }
};
