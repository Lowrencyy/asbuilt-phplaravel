<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeardownLogImage extends Model
{
   protected $fillable = [
    'teardown_log_id',
    'pole_id',
    'photo_type',
    'image_path',
];

    public function teardownLog(): BelongsTo
    {
        return $this->belongsTo(TeardownLog::class);
    }

    public function pole(): BelongsTo
    {
        return $this->belongsTo(Pole::class);
    }
}