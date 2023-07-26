<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Removal extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];


    public function instalation():BelongsTo {
        return $this->belongsTo(Instalation::class,'instalation_id');
    }
}
