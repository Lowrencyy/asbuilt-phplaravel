<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Delivery extends Model
{
    protected $fillable = [
        'transmittal_id',
        'project_id',
        'driver_user_id',
        'driver_name',
        'truck_plate',
        'driver_contact',
        'origin_warehouse_id',
        'destination_warehouse_id',
        'status',
        'departure_photo',
        'arrival_photo',
        'departed_at',
        'arrived_at',
        'received_at',
        'last_latitude',
        'last_longitude',
        'last_location_at',
        'notes',
    ];

    protected $casts = [
        'departed_at'       => 'datetime',
        'arrived_at'        => 'datetime',
        'received_at'       => 'datetime',
        'last_location_at'  => 'datetime',
        'last_latitude'     => 'decimal:7',
        'last_longitude'    => 'decimal:7',
    ];

    public function transmittal(): BelongsTo
    {
        return $this->belongsTo(Transmittal::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_user_id');
    }

    public function originWarehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'origin_warehouse_id');
    }

    public function destinationWarehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'destination_warehouse_id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(DeliveryLocation::class);
    }

    public function latestLocation(): HasMany
    {
        return $this->hasMany(DeliveryLocation::class)->latest('pinged_at')->limit(1);
    }
}
