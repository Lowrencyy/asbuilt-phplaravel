<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'project_code',
        'client',
        'status',
        'project_logo',
    ];

    public function nodes(): HasMany
    {
        return $this->hasMany(Node::class);
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

}