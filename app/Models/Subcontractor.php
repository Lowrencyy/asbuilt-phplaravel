<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    protected $table = 'subcons';

    protected $fillable = [
        'name',
        'description',
        'contact',
        'email',
        'address',
        'warehouse',
        'logo_path',
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path
            ? asset('storage/' . $this->logo_path)
            : null;
    }

    public function members(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'subcontractor_id');
    }
}
