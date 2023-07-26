<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instalation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function images():HasMany {
        return $this->hasMany(InstalationImage::class);
    }

    public function work_order():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

    public function customer():BelongsTo {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function package():BelongsTo {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function due_date():BelongsTo {
        return $this->belongsTo(DueDate::class,'duedate_id');
    }

    public function odp():BelongsTo {
        return $this->belongsTo(MasterOdp::class,'odp_id');
    }

}
