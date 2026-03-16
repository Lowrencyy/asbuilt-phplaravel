<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Node extends Model
{
    protected $fillable = [
        'project_id',
        'node_id',
        'data_source',
        'sites',
        'province',
        'city',
        'team',
        'subcontractor_id',
        'status',
        'approved_by',
        'date_start',
        'due_date',
        'date_finished',
        'file',
        'total_strand_length',
        'expected_cable',
        'actual_cable',
        'extender',
        'node_count',
        'amplifier',
        'tsc',
        'progress_percentage',
    ];

    protected $casts = [
        'date_start' => 'date',
        'due_date' => 'date',
        'date_finished' => 'date',
        'total_strand_length' => 'decimal:2',
        'expected_cable' => 'decimal:2',
        'actual_cable' => 'decimal:2',
        'progress_percentage' => 'decimal:2',
    ];

public function project()
{
    return $this->belongsTo(Project::class);
}

public function subcontractor()
{
    return $this->belongsTo(Subcontractor::class);
}

public function poles()
{
    return $this->hasMany(Pole::class);
}

public function poleSpans()
{
    return $this->hasMany(PoleSpan::class);
}

public function teardownLogs()
{
    return $this->hasMany(TeardownLog::class);
}

public function teardownSubmissions()
{
    return $this->hasMany(TeardownSubmission::class);
}

public function warehouseReceipts()
{
    return $this->hasMany(WarehouseReceipt::class);
}


public function spans(): HasMany
{
    return $this->hasMany(PoleSpan::class);
}

}