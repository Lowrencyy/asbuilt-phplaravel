<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeardownSubmission extends Model
{
    protected $fillable = [
        'project_id',
        'node_id',
        'report_date',
        'team',
        'status',
        'total_cable',
        'total_node',
        'total_amplifier',
        'total_extender',
        'total_tsc',
        'item_status',
        'warehouse_location',
        'entry_mode',
        'manual_reason',
        'manually_added_by',
        'submitted_by',
        'submitted_at',
        'pm_reviewed_by',
        'pm_reviewed_at',
        'telcovantage_reviewed_by',
        'telcovantage_reviewed_at',
        'revision_no',
        // GPS summary
        'gps_center_latitude',
        'gps_center_longitude',
        'gps_min_latitude',
        'gps_max_latitude',
        'gps_min_longitude',
        'gps_max_longitude',
        'gps_log_count',
        'has_offline_logs',
        'gps_summary_notes',
    ];

    protected $casts = [
        'report_date' => 'date',
        'submitted_at' => 'datetime',
        'pm_reviewed_at' => 'datetime',
        'telcovantage_reviewed_at' => 'datetime',
        'total_cable' => 'decimal:2',
        'has_offline_logs' => 'boolean',
        'gps_center_latitude' => 'decimal:7',
        'gps_center_longitude' => 'decimal:7',
        'gps_min_latitude' => 'decimal:7',
        'gps_max_latitude' => 'decimal:7',
        'gps_min_longitude' => 'decimal:7',
        'gps_max_longitude' => 'decimal:7',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function node()
    {
        return $this->belongsTo(Node::class);
    }

    public function items()
    {
        return $this->hasMany(TeardownSubmissionItem::class);
    }

    public function remarks()
    {
        return $this->hasMany(SubmissionRemark::class);
    }

    public function warehouseReceipts()
    {
        return $this->hasMany(WarehouseReceipt::class);
    }
}