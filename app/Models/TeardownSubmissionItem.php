<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeardownSubmissionItem extends Model
{
    protected $fillable = [
        'teardown_submission_id',
        'teardown_log_id',
    ];

    public function submission()
    {
        return $this->belongsTo(TeardownSubmission::class, 'teardown_submission_id');
    }

    public function teardownLog()
    {
        return $this->belongsTo(TeardownLog::class);
    }
}