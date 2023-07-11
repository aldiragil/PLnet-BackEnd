<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function image()
    {
        return $this->hasMany(WorkOrderImage::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'emp_id');
    }
    public function work_order()
    {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

}
