<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pole extends Model
{
    protected $fillable = [
        'node_id',
        'pole_code',
        'status',
        'remarks',
        'completed_at',
        'map_latitude',
        'map_longitude',
    ];

    protected $casts = [
        'completed_at'  => 'datetime',
        'map_latitude'  => 'decimal:7',
        'map_longitude' => 'decimal:7',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }

    public function outgoingSpans(): HasMany
    {
        return $this->hasMany(PoleSpan::class, 'from_pole_id');
    }

    public function incomingSpans(): HasMany
    {
        return $this->hasMany(PoleSpan::class, 'to_pole_id');
    }

    public function teardownImages(): HasMany
    {
        return $this->hasMany(TeardownLogImage::class);
    }
}