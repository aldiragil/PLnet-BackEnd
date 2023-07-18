<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Survey extends Model {

    use HasFactory;
    protected $guarded = [];

    public function image():HasMany {
        return $this->hasMany(SurveyImage::class);
    }

    public function work_order():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'work_order_id');
    }

    public function odp():BelongsTo {
        return $this->belongsTo(WorkOrder::class,'odp_id');
    }

}
