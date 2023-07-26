<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstalationImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function instalation(){
        return $this->belongsTo(Instalation::class,'instalation_id');
    }
}
