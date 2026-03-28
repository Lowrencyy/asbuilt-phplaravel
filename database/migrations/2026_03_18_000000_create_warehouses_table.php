<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subcontractor_id')
                ->constrained('subcons')
                ->cascadeOnDelete();

            // "ABC Contractors Warehouse" or "ABC Contractors Warehouse A"
            $table->string('name');

            // Extension for multiple warehouses: "A", "B", or address string
            $table->string('extension')->nullable();

            // Physical location / address
            $table->text('location')->nullable();

            // primary = auto-created when subcon added
            $table->boolean('is_primary')->default(true);

            // active | inactive
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
