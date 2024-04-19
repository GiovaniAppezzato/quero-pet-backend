<?php

namespace App\Models;

use App\Enums\OngStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ong extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'cnpj',
        'phone',
        'status',
        'responsible_name',
        'responsible_phone',
        'responsible_cpf',
        'status',
        'approved_at',
        'approved_by',
        'user_id',
    ];

    /**
     * Scope a query to only include approved ongs.
     */
    public function scopeApproved($query)
    {
        return $query->whereStatus(OngStatusEnum::APPROVED->value)
            ->whereNotNull('approved_at')
            ->whereNotNull('approved_by');
    }

    /**
     * Get the user that owns the Ong
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * Get the admin that approved the Ong
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }
}
