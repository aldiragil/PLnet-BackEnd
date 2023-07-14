<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderImage extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false; 

    public function work_order_detail() {
        return $this->belongsTo(WorkOrderDetail::class,'work_order_detail_id');
    }

}
