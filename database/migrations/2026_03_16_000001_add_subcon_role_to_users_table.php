<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'subcon_role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('subcon_role')->nullable()->after('subcontractor_id');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('subcon_role');
        });
    }
};
