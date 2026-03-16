<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionRemark extends Model
{
    protected $fillable = [
        'teardown_submission_id',
        'teardown_log_id',
        'pole_id',
        'from_role',
        'from_user',
        'action',
        'remarks',
    ];

    public function submission()
    {
        return $this->belongsTo(TeardownSubmission::class, 'teardown_submission_id');
    }

    public function teardownLog()
    {
        return $this->belongsTo(TeardownLog::class);
    }

    public function pole()
    {
        return $this->belongsTo(Pole::class);
    }
}