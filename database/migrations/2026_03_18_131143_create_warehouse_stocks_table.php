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
        Schema::create('warehouse_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->cascadeOnDelete();
            $table->enum('item_type', ['amplifier','node','tsc','power_supply','power_supply_case','cable']);
            $table->string('description');
            $table->string('unit', 20); // pcs, meters, kg
            $table->decimal('qty_in_stock',   10, 2)->default(0);
            $table->decimal('qty_in_transit', 10, 2)->default(0);
            $table->decimal('qty_deployed',   10, 2)->default(0);
            $table->decimal('qty_damaged',    10, 2)->default(0);
            $table->timestamps();

            $table->unique(['warehouse_id', 'item_type', 'description', 'unit'], 'stocks_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_stocks');
    }
};
