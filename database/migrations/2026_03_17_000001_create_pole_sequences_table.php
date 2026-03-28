<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pole_sequences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('node_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('pole_id')
                ->constrained()
                ->cascadeOnDelete();

            // 0-based position in the day's work order
            $table->unsignedSmallInteger('sort_order')->default(0);

            // Which day this sequence applies to
            $table->date('sequence_date');

            // PM who set the sequence
            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            // One row per pole per day per node
            $table->unique(['node_id', 'pole_id', 'sequence_date'], 'ps_node_pole_date_unique');

            $table->index(['node_id', 'sequence_date'], 'ps_node_date_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pole_sequences');
    }
};
