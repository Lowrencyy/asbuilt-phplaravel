<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeardownLog extends Model
{
    protected $fillable = [
        'project_id',
        'node_id',
        'pole_span_id',
        'team',
        'status',
        'did_collect_all_cable',
        'collected_cable',
        'unrecovered_cable',
        'unrecovered_reason',
        'unrecovered_image',
        'did_collect_components',
        'collected_node',
        'collected_amplifier',
        'collected_extender',
        'collected_tsc',
        'expected_cable_snapshot',
        'expected_node_snapshot',
        'expected_amplifier_snapshot',
        'expected_extender_snapshot',
        'expected_tsc_snapshot',
        'started_at',
        'finished_at',
        'submitted_by',
        // GPS / audit fields (shared)
        'captured_latitude',
        'captured_longitude',
        'gps_accuracy_meters',
        'gps_source',
        'offline_mode',
        'location_notes',
        'captured_at_device',
        'received_at_server',
        'synced_at_server',
        // per-pole GPS
        'from_pole_latitude',
        'from_pole_longitude',
        'from_pole_gps_captured_at',
        'from_pole_gps_accuracy',
        'to_pole_latitude',
        'to_pole_longitude',
        'to_pole_gps_captured_at',
        'to_pole_gps_accuracy',
    ];

    protected $casts = [
        'did_collect_all_cable' => 'boolean',
        'did_collect_components' => 'boolean',
        'offline_mode' => 'boolean',
        'collected_cable' => 'decimal:2',
        'unrecovered_cable' => 'decimal:2',
        'expected_cable_snapshot' => 'decimal:2',
        'captured_latitude' => 'decimal:7',
        'captured_longitude' => 'decimal:7',
        'gps_accuracy_meters' => 'decimal:2',
        'from_pole_latitude' => 'decimal:7',
        'from_pole_longitude' => 'decimal:7',
        'to_pole_latitude' => 'decimal:7',
        'to_pole_longitude' => 'decimal:7',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'captured_at_device' => 'datetime',
        'received_at_server' => 'datetime',
        'synced_at_server' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }

    public function poleSpan(): BelongsTo
    {
        return $this->belongsTo(PoleSpan::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(TeardownLogImage::class);
    }
}