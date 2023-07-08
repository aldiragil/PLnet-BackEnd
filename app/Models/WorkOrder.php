<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function user()
    {
        return $this->belongsToMany(User::class,'work_order_emps');
    }

}
