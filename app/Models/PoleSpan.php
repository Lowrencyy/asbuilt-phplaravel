<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoleSpan extends Model
{
    protected $fillable = [
        'node_id',
        'from_pole_id',
        'to_pole_id',
        'length_meters',
        'runs',
        'expected_cable',
        'expected_node',
        'expected_amplifier',
        'expected_extender',
        'expected_tsc',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'length_meters'  => 'decimal:2',
        'expected_cable' => 'decimal:2',
        'completed_at'   => 'datetime',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }

    public function fromPole(): BelongsTo
    {
        return $this->belongsTo(Pole::class, 'from_pole_id');
    }

    public function toPole(): BelongsTo
    {
        return $this->belongsTo(Pole::class, 'to_pole_id');
    }

    public function teardownLogs(): HasMany
    {
        return $this->hasMany(TeardownLog::class);
    }
}