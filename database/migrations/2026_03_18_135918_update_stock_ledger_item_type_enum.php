<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE stock_ledger MODIFY item_type ENUM(
            'amplifier',
            'node',
            'extender',
            'tsc',
            'power_supply',
            'power_supply_housing',
            'cable'
        ) NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE stock_ledger MODIFY item_type ENUM(
            'amplifier',
            'node',
            'tsc',
            'power_supply',
            'power_supply_case',
            'cable'
        ) NOT NULL");
    }
};
