<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Removal extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function work_order():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

    public function instalation():BelongsTo {
        return $this->belongsTo(Instalation::class,'instalation_id');
    }

    public function images():HasMany {
        return $this->hasMany(RemovalImage::class);
    }
}
