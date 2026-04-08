<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // ── Internal roles ──────────────────────────────────────────────────────
    const ROLE_ADMIN           = 'admin';
    const ROLE_EXECUTIVES      = 'executives';
    const ROLE_HR              = 'hr';
    const ROLE_ACCOUNTING      = 'accounting';
    const ROLE_PROJECT_MANAGER = 'project_manager';
    const ROLE_NORMAL_EMPLOYEE = 'employee';
    const ROLE_SUBCON          = 'subcon';

    // ── Subcontractor sub-roles ──────────────────────────────────────────────
    const SUBCON_PM      = 'pm';
    const SUBCON_LINEMAN = 'lineman';

    // Warehouse role constant
    const ROLE_WAREHOUSE = 'warehouse';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'contact_number',
        'subcon_role',
        'subcontractor_id',
        'is_warehouse_incharge',
        'warehouse_id',
        'team_id',
    ];

    public function isLineman(): bool
    {
        return $this->role === self::ROLE_SUBCON && $this->subcon_role === self::SUBCON_LINEMAN;
    }

    public function isWarehouseInCharge(): bool
    {
        return (bool) $this->is_warehouse_incharge;
    }

    public function subcontractor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Subcontractor::class);
    }

    /** Alias used by live location map */
    public function subcon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Subcontractor::class, 'subcontractor_id');
    }

    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Team::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_active'         => 'boolean',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }
}
