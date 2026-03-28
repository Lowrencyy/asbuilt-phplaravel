<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseStock extends Model
{
    protected $fillable = [
        'warehouse_id',
        'item_type',
        'description',
        'unit',
        'qty_in_stock',
        'qty_in_transit',
        'qty_deployed',
        'qty_damaged',
    ];

    protected $casts = [
        'qty_in_stock'   => 'decimal:2',
        'qty_in_transit' => 'decimal:2',
        'qty_deployed'   => 'decimal:2',
        'qty_damaged'    => 'decimal:2',
    ];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Upsert helper — find or create the stock row, then increment the given column
    public static function adjust(
        int    $warehouseId,
        string $itemType,
        string $description,
        string $unit,
        string $column,
        float  $qty
    ): void {
        $stock = static::firstOrCreate(
            [
                'warehouse_id' => $warehouseId,
                'item_type'    => $itemType,
                'description'  => $description,
                'unit'         => $unit,
            ],
            [
                'qty_in_stock'   => 0,
                'qty_in_transit' => 0,
                'qty_deployed'   => 0,
                'qty_damaged'    => 0,
            ]
        );

        $stock->increment($column, $qty);
    }

    public const ITEM_TYPES = [
        'amplifier'            => ['label' => 'Amplifier',          'icon' => 'settings_input_antenna', 'color' => 'violet'],
        'node'                 => ['label' => 'Node',               'icon' => 'router',                 'color' => 'blue'],
        'extender'             => ['label' => 'Extender',           'icon' => 'cell_tower',             'color' => 'cyan'],
        'tsc'                  => ['label' => 'TSC',                'icon' => 'electrical_services',    'color' => 'orange'],
        'power_supply'         => ['label' => 'Power Supply',       'icon' => 'bolt',                   'color' => 'yellow'],
        'power_supply_housing' => ['label' => 'PS Housing',         'icon' => 'cases',                  'color' => 'slate'],
        'cable'                => ['label' => 'Cable',              'icon' => 'cable',                  'color' => 'teal'],
    ];

    public function getItemTypeLabelAttribute(): string
    {
        return self::ITEM_TYPES[$this->item_type]['label'] ?? ucfirst($this->item_type);
    }

    public function getItemTypeIconAttribute(): string
    {
        return self::ITEM_TYPES[$this->item_type]['icon'] ?? 'inventory_2';
    }
}
