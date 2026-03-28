<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransmittalItem extends Model
{
    protected $fillable = [
        'transmittal_id',
        'node_id',
        'item_type',
        'item_description',
        'unit',
        'quantity_requested',
        'quantity_approved',
        'quantity_received',
        'notes',
    ];

    protected $casts = [
        'quantity_requested' => 'decimal:2',
        'quantity_approved'  => 'decimal:2',
        'quantity_received'  => 'decimal:2',
    ];

    public function transmittal(): BelongsTo
    {
        return $this->belongsTo(Transmittal::class);
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }

    // Gap between approved and received (how much is still missing)
    public function getGapAttribute(): float
    {
        $approved  = (float) ($this->quantity_approved ?? $this->quantity_requested);
        $received  = (float) ($this->quantity_received ?? 0);
        return max(0, $approved - $received);
    }
}
