<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOdpImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    public function odp(){
        return $this->belongsTo(MasterOdpImage::class,'master_odp_id');
    }

}
