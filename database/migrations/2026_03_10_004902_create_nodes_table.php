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
        Schema::create('nodes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnDelete();

            $table->string('node_id');
            $table->enum('data_source', ['manual', 'ai'])->default('manual');

            $table->string('sites')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('team')->nullable();
            $table->string('status')->default('pending');
            $table->string('approved_by')->nullable();

            $table->date('date_start')->nullable();
            $table->date('due_date')->nullable();
            $table->date('date_finished')->nullable();

            $table->string('file')->nullable();

            $table->decimal('total_strand_length', 12, 2)->default(0);
            $table->decimal('expected_cable', 12, 2)->default(0);
            $table->decimal('actual_cable', 12, 2)->default(0);

            $table->integer('extender')->default(0);
            $table->integer('node_count')->default(1);
            $table->integer('amplifier')->default(0);
            $table->integer('tsc')->default(0);

            $table->decimal('progress_percentage', 5, 2)->default(0);

            $table->timestamps();

            $table->unique(['project_id', 'node_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nodes');
    }
};