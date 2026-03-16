<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseReceipt extends Model
{
    protected $fillable = [
        'warehouse_receipt_id',
        'teardown_submission_id',
        'project_id',
        'node_id',
        'delivery_date',
        'teardown_date',
        'pole_source',
        'collected_cable',
        'collected_node',
        'collected_amplifier',
        'collected_extender',
        'collected_tsc',
        'delivery_proof',
        'warehouse_location',
        'status',
        'entry_mode',
        'manual_reason',
        'manually_added_by',
        'team_id',
    ];

    protected $casts = [
        'delivery_date' => 'date',
        'teardown_date' => 'date',
        'collected_cable' => 'decimal:2',
    ];

    public function submission()
    {
        return $this->belongsTo(TeardownSubmission::class, 'teardown_submission_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}