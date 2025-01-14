<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Link extends Model
{
    use HasFactory;
protected $table = 'links';

protected $fillable = 
[
    'created_by',
    'guest_id',
    'two_factor_enabled',
    'token',
    'valid_from',
    'expires_at'
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function twoFactor(): HasMany
    {
        return $this->hasMany(TwoFactor::class, 'link_id');
    }

}

