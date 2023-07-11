<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderEmp extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function work_order() {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

}
