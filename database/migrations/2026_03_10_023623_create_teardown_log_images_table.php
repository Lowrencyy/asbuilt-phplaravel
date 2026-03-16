<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teardown_log_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teardown_log_id')
                ->constrained('teardown_logs')
                ->cascadeOnDelete();

            $table->foreignId('pole_id')
                ->constrained('poles')
                ->cascadeOnDelete();

            $table->string('photo_type');
            // before, after, pole_tag, supporting, missing_cable

            $table->string('image_path');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teardown_log_images');
    }
};