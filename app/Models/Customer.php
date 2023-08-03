<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'user_id',
        'group_id',
        'payment_id',
        'active',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function work_order(): HasMany {
        return $this->hasMany(work_order::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class,'user_id');
    }

    public function group(): BelongsTo {
        return $this->belongsTo(User::class,'group_id');
    }

}
