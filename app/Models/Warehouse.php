<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    protected $fillable = [
        'subcontractor_id',
        'name',
        'extension',
        'location',
        'is_primary',
        'status',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function subcontractor(): BelongsTo
    {
        return $this->belongsTo(Subcontractor::class, 'subcontractor_id', 'id');
    }

    public function inchargeUsers(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function outgoingTransmittals(): HasMany
    {
        return $this->hasMany(Transmittal::class, 'origin_warehouse_id');
    }

    public function incomingTransmittals(): HasMany
    {
        return $this->hasMany(Transmittal::class, 'destination_warehouse_id');
    }

    public function outgoingDeliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'origin_warehouse_id');
    }

    public function incomingDeliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'destination_warehouse_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(WarehouseStock::class);
    }

    // Full display name e.g. "ABC Contractors Warehouse A"
    public function getDisplayNameAttribute(): string
    {
        return $this->name . ($this->extension ? ' ' . $this->extension : '');
    }
}
