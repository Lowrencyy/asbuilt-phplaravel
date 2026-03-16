<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pole_spans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('node_id')
                ->constrained('nodes')
                ->cascadeOnDelete();

            
            $table->foreignId('from_pole_id')
                ->constrained('poles')
                ->cascadeOnDelete();

            $table->foreignId('to_pole_id')
                ->constrained('poles')
                ->cascadeOnDelete();

            // $table->string('direction_label')->nullable();
            // north, south, east, west, custom
            
            // $table->deciman('span_id') -> default(0);

            $table->decimal('length_meters', 10, 2)->default(0);
            $table->integer('runs')->default(1);
            $table->decimal('expected_cable', 10, 2)->default(0);

            $table->integer('expected_node')->default(0);
            $table->integer('expected_amplifier')->default(0);
            $table->integer('expected_extender')->default(0);
            $table->integer('expected_tsc')->default(0);

            $table->string('status')->default('pending');
            // pending, in_progress, teardown, blocked, completed

      

            $table->timestamp('completed_at')->nullable();

            $table->unique(['from_pole_id', 'to_pole_id']);

            $table->timestamps();
        });

        
    }

    public function down(): void
    {
        Schema::dropIfExists('pole_spans');
    }
};