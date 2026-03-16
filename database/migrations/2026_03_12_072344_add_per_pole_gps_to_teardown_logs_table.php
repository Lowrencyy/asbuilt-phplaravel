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
        Schema::table('teardown_logs', function (Blueprint $table) {
            $table->decimal('from_pole_latitude',  10, 7)->nullable()->after('location_notes');
            $table->decimal('from_pole_longitude', 10, 7)->nullable()->after('from_pole_latitude');
            $table->string('from_pole_gps_captured_at')->nullable()->after('from_pole_longitude');
            $table->string('from_pole_gps_accuracy')->nullable()->after('from_pole_gps_captured_at');

            $table->decimal('to_pole_latitude',  10, 7)->nullable()->after('from_pole_gps_accuracy');
            $table->decimal('to_pole_longitude', 10, 7)->nullable()->after('to_pole_latitude');
            $table->string('to_pole_gps_captured_at')->nullable()->after('to_pole_longitude');
            $table->string('to_pole_gps_accuracy')->nullable()->after('to_pole_gps_captured_at');
        });
    }

    public function down(): void
    {
        Schema::table('teardown_logs', function (Blueprint $table) {
            $table->dropColumn([
                'from_pole_latitude', 'from_pole_longitude',
                'from_pole_gps_captured_at', 'from_pole_gps_accuracy',
                'to_pole_latitude', 'to_pole_longitude',
                'to_pole_gps_captured_at', 'to_pole_gps_accuracy',
            ]);
        });
    }
};
