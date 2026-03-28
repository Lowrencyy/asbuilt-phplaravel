<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // New canonical list: amplifier, node, extender, tsc, power_supply, power_supply_housing, cable
    private const ENUM = "'amplifier','node','extender','tsc','power_supply','power_supply_housing','cable'";

    public function up(): void
    {
        DB::statement('ALTER TABLE warehouse_stocks MODIFY item_type ENUM(' . self::ENUM . ') NOT NULL');
        DB::statement('ALTER TABLE stock_ledger MODIFY item_type ENUM(' . self::ENUM . ') NOT NULL');
    }

    public function down(): void
    {
        $old = "'amplifier','node','tsc','power_supply','power_supply_case','cable'";
        DB::statement("ALTER TABLE warehouse_stocks MODIFY item_type ENUM({$old}) NOT NULL");
        DB::statement("ALTER TABLE stock_ledger MODIFY item_type ENUM({$old}) NOT NULL");
    }
};
