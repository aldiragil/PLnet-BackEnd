<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model {

    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'work_order_id',
        'customer_id',
        'package_id',
        'odp_id',
        'active',
        'created_by',
        'updated_by',
        'updated_at'
    ];


    public function image():HasMany {
        return $this->hasMany(SurveyImage::class);
    }

    public function work_order():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

    public function package():BelongsTo {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function odp():BelongsTo {
        return $this->belongsTo(MasterOdp::class,'odp_id');
    }

    public function customer():BelongsTo {
        return $this->belongsTo(Customer::class,'customer_id');
    }

}
