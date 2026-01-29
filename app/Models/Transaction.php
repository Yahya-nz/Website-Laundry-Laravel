<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'type',
        'amount',
        'currency',
        'status',
        'notes',
        'target_user_id'
    ];

    protected static function booted()
    {
        static::creating(function ($t) {
            $t->uuid = Str::upper(Str::random(12));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'target_user_id');
    }
}
