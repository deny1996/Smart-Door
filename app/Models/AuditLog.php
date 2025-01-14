<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs';

    protected $fillable = [
     'created_by',
     'guest',
     'action',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Link::class, 'created_by');
    }

    public function usedBy(): BelongsTo
    {
        return $this->belongsTo(Link::class, 'guest');
    }
    
}
