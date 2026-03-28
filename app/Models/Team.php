<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    protected $fillable = [
        'team_name',
        'team_email',
        'contact_number',
        'address',
        'logo',
        'status',
        'subcon_id',
    ];

    public function subcontractor(): BelongsTo
    {
        return $this->belongsTo(Subcontractor::class, 'subcon_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'team_id');
    }

    public function warehouseReceipts(): HasMany
    {
        return $this->hasMany(WarehouseReceipt::class);
    }
}
