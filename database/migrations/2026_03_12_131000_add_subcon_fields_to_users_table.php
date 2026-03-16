<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('subcontractor_id')
                ->nullable()
                ->constrained('subcons')
                ->nullOnDelete()
                ->after('role');
            $table->string('subcon_role')->nullable()->after('subcontractor_id');
            $table->boolean('is_warehouse_incharge')->default(false)->after('subcon_role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['subcontractor_id']);
            $table->dropColumn(['subcontractor_id', 'subcon_role', 'is_warehouse_incharge']);
        });
    }
};
