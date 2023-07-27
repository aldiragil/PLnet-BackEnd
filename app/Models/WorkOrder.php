<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'pivot',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsToMany(User::class,'work_order_emps');
    }

    public function detail() {
        return $this->hasMany(WorkOrderDetail::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class,'customer_id');
    }

}
