<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teardown_submissions', function (Blueprint $table) {
            $table->integer('total_powersupply')->default(0)->after('total_tsc');
            $table->integer('total_powersupply_housing')->default(0)->after('total_powersupply');
            $table->decimal('total_strand_length', 12, 2)->default(0)->after('total_cable');
        });
    }

    public function down(): void
    {
        Schema::table('teardown_submissions', function (Blueprint $table) {
            $table->dropColumn(['total_powersupply', 'total_powersupply_housing', 'total_strand_length']);
        });
    }
};
