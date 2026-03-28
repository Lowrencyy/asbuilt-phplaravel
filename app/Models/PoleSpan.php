<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoleSpan extends Model
{
    /**
     * When a new span is added linking two poles, reset either pole that was
     * prematurely marked "completed" back to "active" so the completion check
     * runs again once the new span's teardown is submitted.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::created(function (PoleSpan $span) {
            foreach (['from_pole_id', 'to_pole_id'] as $key) {
                if ($span->$key) {
                    \App\Models\Pole::where('id', $span->$key)
                        ->where('status', 'completed')
                        ->update(['status' => 'active', 'completed_at' => null]);
                }
            }
        });
    }

    protected $fillable = [
        'node_id',
        'from_pole_id',
        'to_pole_id',
        'pole_span_code',
        'length_meters',
        'runs',
        'expected_powersupply',
        'expected_powersupply_housing',
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