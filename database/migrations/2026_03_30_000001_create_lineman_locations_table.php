<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lineman_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->timestamp('last_seen_at')->useCurrent();
            $table->timestamps();

            $table->unique('user_id'); // one row per lineman, upserted on each ping
        });
    }

    public function down(): void {
        Schema::dropIfExists('lineman_locations');
    }
};
