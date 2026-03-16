<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('node_id')
                ->constrained('nodes')
                ->cascadeOnDelete();

            $table->string('pole_code');
            $table->string('status')->default('pending');
            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->unique(['node_id', 'pole_code']);
            $table->timestamp('completed_at')->nullable();

            $table->decimal('map_latitude', 10, 7)->nullable();
            $table->decimal('map_longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poles');
    }
};