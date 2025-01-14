<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactor extends Model
{
    use HasFactory;

    protected $table = 'two_factors';

    protected $fillable = [
        'code',
        'valid_until',
        'link_id',
    ];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class, 'id');
    }

}
