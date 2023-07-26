<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Time extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'id',
    ];
    public $timestamps = false;
    public function due_date(): HasMany {
        return $this->hasMany(DueDate::class);
    }
}
