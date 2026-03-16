<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->foreignId('subcontractor_id')
                ->nullable()
                ->constrained('subcons')
                ->nullOnDelete()
                ->after('team');
        });
    }

    public function down(): void
    {
        Schema::table('nodes', function (Blueprint $table) {
            $table->dropForeign(['subcontractor_id']);
            $table->dropColumn('subcontractor_id');
        });
    }
};
