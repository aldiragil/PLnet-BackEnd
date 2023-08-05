<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemovalImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function removal(){
        return $this->belongsTo(Instalation::class,'removal_id');
    }
}
