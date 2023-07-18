<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterOdp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function image(){
        return $this->hasMany(MasterOdpImage::class);
    }

    public function work_order():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

}
