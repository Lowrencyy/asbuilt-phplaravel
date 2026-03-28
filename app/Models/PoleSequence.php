<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PoleSequence extends Model
{
    protected $fillable = [
        'node_id',
        'pole_id',
        'sort_order',
        'sequence_date',
        'assigned_by',
    ];

    protected $casts = [
        'sequence_date' => 'date',
        'sort_order'    => 'integer',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }

    public function pole(): BelongsTo
    {
        return $this->belongsTo(Pole::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
