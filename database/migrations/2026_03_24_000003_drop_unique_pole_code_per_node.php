<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            // Add a plain index on node_id first so MySQL doesn't lose the FK index support
            $table->index('node_id', 'poles_node_id_index');
        });

        Schema::table('poles', function (Blueprint $table) {
            $table->dropUnique(['node_id', 'pole_code']);
        });
    }

    public function down(): void
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->unique(['node_id', 'pole_code']);
            $table->dropIndex('poles_node_id_index');
        });
    }
};
