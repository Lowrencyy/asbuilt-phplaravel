<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    ];

    public function warehouseReceipts(): HasMany
    {
        return $this->hasMany(WarehouseReceipt::class);
    }
}
