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
        Schema::create('stock_ledger', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->cascadeOnDelete();
            $table->enum('item_type', ['amplifier','node','tsc','power_supply','power_supply_case','cable']);
            $table->string('description');
            $table->string('unit', 20);
            $table->decimal('quantity', 10, 2);                   // + in, - out
            $table->enum('movement_type', [
                'received',     // delivery arrived + received
                'dispatched',   // transmittal approved, left warehouse
                'deployed',     // daily report approved
                'damaged',      // reported damaged
                'adjustment',   // manual correction
            ]);
            $table->string('reference_type')->nullable();         // App\Models\Delivery etc.
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ledger');
    }
};
